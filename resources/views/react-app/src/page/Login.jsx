import { useState } from "react";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { FaApple, FaCheckCircle, FaEnvelope, FaLock } from "react-icons/fa";
import { GoogleLogin } from "@react-oauth/google";
import "../assets/css/Login.css";
import houseImg from "../assets/img/feature-property/fp-1.jpg";
import { useAuth } from "../context/AuthContext";

export default function Login() {
  const navigate = useNavigate();
  const location = useLocation();
  const { login, loginGoogle, loginApple } = useAuth();
  const [form, setForm] = useState({ email: "", password: "" });
  const [errors, setErrors] = useState({});
  const [emailValid, setEmailValid] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const [generalError, setGeneralError] = useState("");

  const handleChange = (event) => {
    const { name, value } = event.target;

    setForm((prev) => ({ ...prev, [name]: value }));
    setGeneralError("");

    if (name === "email") {
      setEmailValid(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value));
    }

    if (errors[name]) {
      setErrors((prev) => ({ ...prev, [name]: "" }));
    }
  };

  const validate = () => {
    const nextErrors = {};

    if (!form.email.trim()) nextErrors.email = "Email is required";
    else if (!emailValid) nextErrors.email = "Enter a valid email";

    if (!form.password) nextErrors.password = "Password is required";

    return nextErrors;
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    const nextErrors = validate();

    if (Object.keys(nextErrors).length > 0) {
      setErrors(nextErrors);
      return;
    }

    try {
      setSubmitting(true);
      setGeneralError("");
      await login(form);
      navigate(location.state?.from?.pathname || "/profile", { replace: true });
    } catch (requestError) {
      setGeneralError(requestError.message || "Unable to log you in right now.");
    } finally {
      setSubmitting(false);
    }
  };

  const handleGoogleSuccess = async (credentialResponse) => {
    try {
      setSubmitting(true);
      setGeneralError("");
      await loginGoogle({
        id_token: credentialResponse.credential,
      });
      navigate(location.state?.from?.pathname || "/profile", { replace: true });
    } catch (error) {
      setGeneralError(error.message || "Unable to login with Google.");
    } finally {
      setSubmitting(false);
    }
  };

  const handleGoogleError = () => {
    setGeneralError("Failed to initialize Google Sign-In login. Please try again.");
  };

  const handleAppleClick = async () => {
    if (!window.AppleID) {
      setGeneralError("Apple Sign-In is not available. Please try again later.");
      return;
    }

    try {
      setSubmitting(true);
      setGeneralError("");
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
        navigate(location.state?.from?.pathname || "/profile", { replace: true });
      }
    } catch (error) {
      setGeneralError(error.message || "Unable to login with Apple.");
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="login-page">
      <div className="login-card">
        <div className="login-left">
          <h1 className="login-title">Sign in</h1>

          <form className="login-form" onSubmit={handleSubmit} noValidate>
            <div className={`login-field ${errors.email ? "has-error" : ""}`}>
              <FaEnvelope className="login-field-icon" />
              <input
                type="email"
                name="email"
                placeholder="Your email"
                value={form.email}
                onChange={handleChange}
                autoComplete="email"
              />
              {emailValid && <FaCheckCircle className="login-field-check" />}
            </div>
            {errors.email && <p className="login-error">{errors.email}</p>}

            <div
              className={`login-field ${errors.password ? "has-error" : ""}`}
            >
              <FaLock className="login-field-icon" />
              <input
                type="password"
                name="password"
                placeholder="Password"
                value={form.password}
                onChange={handleChange}
                autoComplete="current-password"
              />
            </div>
            {errors.password && <p className="login-error">{errors.password}</p>}

            <p className="login-signup-text">
              Don't have an account?{" "}
              <Link to="/register" className="login-create-link">
                Create one
              </Link>
            </p>
            <p className="login-signup-text">
              Forgot your password?{" "}
              <Link to="/forgot-password" className="login-create-link">
                Reset it
              </Link>
            </p>
            {generalError ? <p className="login-error">{generalError}</p> : null}

            <button
              type="submit"
              className="login-submit-btn"
              disabled={submitting}
            >
              {submitting ? "Logging in..." : "Login"}
            </button>

            <div className="login-divider">
              <span>OR</span>
            </div>

            <div style={{ display: "flex", justifyContent: "center", margin: "12px 0" }}>
              <GoogleLogin
                onSuccess={handleGoogleSuccess}
                onError={handleGoogleError}
                type="standard"
                theme="outline"
                size="large"
                text="signin_with"
              />
            </div>

            <button
              type="button"
              className="login-social-btn login-apple-btn"
              disabled={submitting}
              onClick={handleAppleClick}
            >
              <FaApple className="login-social-icon" />
              Login with Apple
            </button>
          </form>
        </div>

        <div className="login-right">
          <div className="login-img-wrap">
            <img
              src={houseImg}
              alt="Real estate illustration"
              className="login-house-img"
            />
          </div>
        </div>
      </div>
    </div>
  );
}