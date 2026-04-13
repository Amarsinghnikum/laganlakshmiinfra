# Google & Apple Sign-In Fix - Setup Instructions

## What Was The Issue?

The Google and Apple logins were failing with validation errors:
```
Google: {status: false, message: "Validation failed", errors: {id_token: ["The id token field is required."]}}
Apple: {status: false, message: "Validation failed", errors: {identity_token: ["The identity token field is required."]}}
```

This was happening because:
1. The frontend wasn't obtaining OAuth tokens from Google/Apple
2. The frontend was trying to call the backend API without the required token fields

## What Was Fixed?

1. ✅ Added `@react-oauth/google` package to handle Google Sign-In
2. ✅ Added Apple Sign-In SDK and handlers
3. ✅ Updated `main.jsx` to wrap the app with `GoogleOAuthProvider`
4. ✅ Updated `SignIn.jsx` to use the `GoogleLogin` component and Apple handler
5. ✅ Updated `Login.jsx` to use the `GoogleLogin` component and Apple handler
6. ✅ Both components now properly extract OAuth tokens and send them to the backend

## What You Need To Do

### 1. Get Google OAuth 2.0 Credentials

a. Go to [Google Cloud Console](https://console.cloud.google.com/)
b. Create a new project or select an existing one
c. Enable the Google+ API
d. Go to "Credentials" and create a new OAuth 2.0 Client ID (Web application)
e. Add authorized redirect URIs (e.g., `http://localhost:3000`, `http://localhost`, your production domain)
f. Copy the **Client ID**

### 1b. Get Apple Sign-In Credentials

a. Go to [Apple Developer Account](https://developer.apple.com/account/)
b. Register a new App ID with Sign in with Apple capability
c. Create a Service ID for web configuration
d. Configure your private relay email domain
e. Get your:
   - **Team ID** (10 alphanumeric characters)
   - **Service ID** (use for REACT_APP_APPLE_CLIENT_ID)
   - **Key ID** (from the generated private key)

### 2. Create React App .env File

Create a `.env` file in the `resources/views/react-app/` directory:

```bash
cd resources/views/react-app
cp .env.example .env
```

### 3. Add Credentials to .env

Edit `resources/views/react-app/.env` and add all required credentials:

```
REACT_APP_GOOGLE_CLIENT_ID=your_google_client_id_here
REACT_APP_APPLE_CLIENT_ID=com.laganlakshmiinfra.web
REACT_APP_APPLE_TEAM_ID=your_apple_team_id_here
REACT_APP_APPLE_KEY_ID=your_apple_key_id_here
```

Replace with actual values from Google Cloud Console and Apple Developer Account.

### 4. Install Dependencies

```bash
npm install
```

### 5. Run the Application

```bash
npm run dev
# or for production
npm run prod
```

## How It Works Now

### Google Sign-In Flow

1. When a user clicks "Continue with Google", the `GoogleLogin` component from `@react-oauth/google` is displayed
2. The user authenticates with Google
3. Google returns an ID token (JWT)
4. The `handleGoogleSuccess` callback extracts this token
5. The token is sent to your backend at `/api/login/google` with the `id_token` field
6. The backend verifies the token and logs the user in

### Apple Sign-In Flow

1. When a user clicks "Continue with Apple", the Apple Sign in with Apple SDK is initialized
2. The user authenticates with their Apple ID
3. Apple returns an identity token (JWT) + optional user data (name, email)
4. The `handleAppleClick` callback extracts the identity token
5. The token is sent to your backend at `/api/login/apple` with the `identity_token` field
6. The backend verifies the token and logs the user in

## Testing

1. Build your React app: `npm run prod`
2. Start your Laravel server
3. Navigate to the login page
4. Click "Continue with Google" or "Continue with Apple"
5. Complete the authentication flow
6. You should now be logged in!

## Backend Verification

The backend controllers will:
- **GoogleLoginController**: Verify the Google ID token, extract user info, create/update user, return auth token
- **AppleController**: Verify the Apple identity token, extract user info, create/update user, return auth token

## Troubleshooting

**Issue: "The id token field is required" error (Google)**
- Make sure `REACT_APP_GOOGLE_CLIENT_ID` is set in `.env`
- Clear browser cache and rebuild the app: `npm run prod`
- Check that the GoogleLogin component is rendering properly
- Verify your app is using HTTPS (required for Google on production)

**Issue: "The identity_token field is required" error (Apple)**
- Make sure `REACT_APP_APPLE_CLIENT_ID`, `REACT_APP_APPLE_TEAM_ID`, and `REACT_APP_APPLE_KEY_ID` are set in `.env`
- Clear browser cache and rebuild the app
- Verify that `window.AppleID` is available (check browser console)
- Ensure your Apple service is configured for web in Apple Developer Account
- Verify your domain is whitelisted in Apple Developer settings

**Issue: "Invalid or expired token"**
- The token from the OAuth provider couldn't be verified by the backend
- Check that your credentials are correctly entered
- Ensure backend has the correct keys for verification

**Issue: CORS errors**
- Check your CORS configuration in `config/cors.php`
- Ensure your frontend URL is allowed

**Issue: GoogleLogin component not showing**
- Check that `REACT_APP_GOOGLE_CLIENT_ID` environment variable is set
- Verify the app was rebuilt after changing the `.env` file
- Check browser console for any errors

**Issue: Apple Sign-In button not responding**
- Check browser console for JavaScript errors
- Verify Apple SDK is loaded: `window.AppleID` should be defined
- Ensure your domain is in Apple Developer settings whitelist
- Verify Apple Service ID matches `REACT_APP_APPLE_CLIENT_ID`
- Check browser compatibility (Apple Sign-In works on newer browsers)

## Files Modified

- `resources/views/react-app/src/main.jsx` - Added GoogleOAuthProvider
- `resources/views/react-app/src/page/SignIn.jsx` - Integrated GoogleLogin component and Apple handler
- `resources/views/react-app/src/page/Login.jsx` - Integrated GoogleLogin component and Apple handler
- `resources/views/react-app/public/index.html` - Added Apple Sign-In SDK script
- `resources/views/react-app/.env.example` - Added Google and Apple credential templates
- `package.json` - Added `@react-oauth/google` dependency

## Backend Files (Already Implemented)

- `routes/api.php` - `/api/login/google` route
- `app/Http/Controllers/Api/GoogleLoginController.php` - Handles Google token verification
