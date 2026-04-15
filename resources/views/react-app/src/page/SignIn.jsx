import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { GoogleLogin } from "@react-oauth/google";
import "../assets/css/signup.css";
import logo from "../assets/img/logo.jpg";
import { useAuth } from "../context/AuthContext";

const Signin = () => {
  const navigate = useNavigate();
  const { login, loginGoogle, loginApple } = useAuth();
  const [formData, setFormData] = useState({
    login: "",
    password: ""
  });
  const [showPassword, setShowPassword] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
    setErrorMessage("");
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!formData.login.trim() || !formData.password) {
      setErrorMessage("Please enter your email/phone and password.");
      return;
    }

    try {
      setSubmitting(true);
      setErrorMessage("");
      await login({
        login: formData.login.trim(),
        password: formData.password,
      });
      navigate("/");
    } catch (error) {
      setErrorMessage(error.message || "Unable to log in right now.");
    } finally {
      setSubmitting(false);
    }
  };

  const handleGoogleSuccess = async (credentialResponse) => {
    try {
      setSubmitting(true);
      setErrorMessage("");
      await loginGoogle({
        id_token: credentialResponse.credential,
      });
      navigate("/");
    } catch (error) {
      setErrorMessage(error.message || "Unable to login with Google.");
    } finally {
      setSubmitting(false);
    }
  };

  const handleGoogleError = () => {
    setErrorMessage("Failed to initialize Google Sign-In login. Please try again.");
  };

  const handleAppleClick = async () => {
    if (!window.AppleID) {
      setErrorMessage("Apple Sign-In is not available. Please try again later.");
      return;
    }

    try {
      setSubmitting(true);
      setErrorMessage("");
      await window.AppleID.auth.init({
        clientId: process.env.REACT_APP_APPLE_CLIENT_ID || "com.laganlakshmiinfra.web",
        teamId: process.env.REACT_APP_APPLE_TEAM_ID || "",
        keyId: process.env.REACT_APP_APPLE_KEY_ID || "",
        redirectURI: window.location.origin,
        usePopup: true,
        scope: "email name",
      });

      const response = await window.AppleID.auth.signIn();
      
      if (response && response.authorization && response.authorization.id_token) {
        await loginApple({
          identity_token: response.authorization.id_token,
          email: response.user?.email || null,
          name: response.user?.name?.firstName || null,
        });
        navigate("/");
      }
    } catch (error) {
      setErrorMessage(error.message || "Unable to login with Apple.");
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="signin-container">
      <div className="signin-card">

        {/* Logo Section */}
        <div className="logo-section">
          <img src={logo} alt="Lagan Lakshmi Infra" />
          <h2>Lagan Lakshmi Infra</h2>
          <p>Sign in to continue</p>
        </div>

        {/* Form */}
        <form onSubmit={handleSubmit}>
          <label>Email or Phone</label>
          <div className="input-group">
            <input
              type="text"
              name="login"
              placeholder="Email or Phone"
              onChange={handleChange}
              required
            />
          </div>

          <label>Password</label>
          <div className="input-group password-group">
            <input
              type={showPassword ? "text" : "password"}
              name="password"
              placeholder="Password"
              onChange={handleChange}
              required
            />
            <span
              className="eye-icon"
              onClick={() => setShowPassword(!showPassword)}
            >
              👁
            </span>
          </div>

          <div className="forgot">
            Forgot Password?
          </div>

          {errorMessage ? <p className="field-error" style={{ textAlign: "center", marginBottom: 16 }}>{errorMessage}</p> : null}
          <button type="submit" className="signin-btn" disabled={submitting}>
            {submitting ? "Signing In…" : "Sign In"}
          </button>
        </form>

        {/* Divider */}
        <div className="divider"></div>

        {/* Social Login */}
        <div style={{ display: "flex", justifyContent: "center", marginBottom: "12px" }}>
          <GoogleLogin
            onSuccess={handleGoogleSuccess}
            onError={handleGoogleError}
            type="standard"
            theme="outline"
            size="large"
            text="signin_with"
          />
        </div>

        <button type="button" className="apple-btn" onClick={handleAppleClick} disabled={submitting}> 
          <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
          </svg>
          Continue with Apple
        </button>

        {/* Footer */}
        <p className="footer-text">
          Don't have an account? <Link to="/signup" style={{color: '#27ae60', fontWeight: '600'}}>Sign Up</Link>
        </p>

        <p className="terms">
          By continuing, you agree to our <span>Terms of Service</span> and <span>Privacy Policy</span>
        </p>

      </div>
    </div>
  );
};

export default Signin;
