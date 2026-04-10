# Fix CORS & API Fetch Errors

## Steps:
- [ ] 1. Edit `resources/views/react-app/vite.config.js` - Change proxy targets to local backend `http://localhost/laganlakshmiinfra`
- [ ] 2. Edit `resources/views/react-app/src/utils/propertyData.js` - Remove prod URL fallback
- [ ] 3. Restart Vite dev server (`npm run dev` or whatever start command)
- [ ] 4. php artisan config:clear route:clear (optional)
- [ ] 5. Test console - no CORS/JSON errors
