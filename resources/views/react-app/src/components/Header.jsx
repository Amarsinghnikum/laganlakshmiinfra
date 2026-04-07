import {
  FaEnvelope,
  FaFacebookF,
  FaTwitter,
  FaYoutube,
  FaInstagram,
  FaPinterestP,
  FaPhone,
  FaBars,
  FaTimes,
} from "react-icons/fa";

import { useState, useEffect } from "react";
import { NavLink, useNavigate } from "react-router-dom";
import logo from "../assets/img/logo.jpg";
import "../assets/css/Header.css";
import Properties from "../page/Properties";

const NAV_LINKS = [
  { label: "Home", path: "/" },
  { label: "About", path: "/about" },
  { label: "Properties", path: "/properties" },
  { label: "Contact", path: "/contact" },
  { label: "Terms & Conditions", path: "/terms-and-conditions" },
  { label: "Privacy Policy", path: "/privacy-policy" },
];

const SOCIALS = [
  { icon: <FaFacebookF />, href: "https://facebook.com", label: "Facebook" },
  { icon: <FaTwitter />, href: "https://twitter.com", label: "Twitter" },
  { icon: <FaYoutube />, href: "https://youtube.com", label: "YouTube" },
  { icon: <FaInstagram />, href: "https://instagram.com", label: "Instagram" },
  { icon: <FaPinterestP />, href: "https://pinterest.com", label: "Pinterest" },
];

export default function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const navigate = useNavigate();

  const closeMenu = () => setMenuOpen(false);

  /* Prevent body scroll when sidebar open */
  useEffect(() => {
    document.body.style.overflow = menuOpen ? "hidden" : "auto";
    return () => {
      document.body.style.overflow = "auto";
    };
  }, [menuOpen]);

  return (
    <>
      <header className="main-header">
        {/* ================= TOP BAR ================= */}
        <div className="header-top">
          <div className="container header-top-inner">
            {/* Logo */}
            <div
              className="logo"
              onClick={() => navigate("/")}
              style={{ cursor: "pointer" }}
            >
              <img src={logo} alt="Lagan Lakshmi Infra" />
            </div>

            {/* Contact info — scoped inside .main-header in CSS */}
            <div className="contact-wrapper">
              <div className="contact-item">
                <div className="icon-box">
                  <FaEnvelope />
                </div>
                <div className="contact-text">info@laganlakshmiinfra.com</div>
              </div>
              <div className="contact-item">
                <div className="icon-box">
                  <FaPhone />
                </div>
                <div className="contact-text">+918595543869</div>
              </div>
            </div>

            {/* Submit button */}
            <button
              className="submit-btn"
              onClick={() => navigate("/submit-property")}
            >
              Submit Property
            </button>

            {/* Hamburger (mobile only) */}
            <div className="mobile-menu-btn" onClick={() => setMenuOpen(true)}>
              <FaBars />
            </div>
          </div>
        </div>

        {/* ================= NAVIGATION ================= */}
        <div className="header-nav">
          <div className="container nav-inner">
            <ul className="nav-menu">
              {NAV_LINKS.map(({ label, path }) => (
                <li key={path}>
                  <NavLink
                    to={path}
                    end={path === "/"}
                    className={({ isActive }) => (isActive ? "active" : "")}
                  >
                    {label}
                  </NavLink>
                </li>
              ))}
            </ul>

            <div className="social-icons">
              {SOCIALS.map(({ icon, href, label }) => (
                <a
                  key={label}
                  href={href}
                  target="_blank"
                  rel="noreferrer"
                  aria-label={label}
                >
                  {icon}
                </a>
              ))}
            </div>
          </div>
        </div>
      </header>

      {/* ================= OVERLAY ================= */}
      <div
        className={`overlay ${menuOpen ? "active" : ""}`}
        onClick={closeMenu}
      />

      {/* ================= SIDEBAR ================= */}
      <div className={`sidebar ${menuOpen ? "active" : ""}`}>
        <div className="sidebar-close" onClick={closeMenu}>
          <FaTimes />
        </div>

        <div
          className="sidebar-logo"
          onClick={() => {
            navigate("/");
            closeMenu();
          }}
          style={{ cursor: "pointer" }}
        >
          <img src={logo} alt="Logo" />
        </div>

        <ul className="sidebar-nav">
          {NAV_LINKS.map(({ label, path }) => (
            <li key={path}>
              <NavLink
                to={path}
                end={path === "/"}
                className={({ isActive }) => (isActive ? "active" : "")}
                onClick={closeMenu}
              >
                {label}
              </NavLink>
            </li>
          ))}
        </ul>

        <div className="sidebar-contact">
          <div className="sidebar-contact-item">
            <div className="icon-box">
              <FaEnvelope />
            </div>
            <p>info@laganlakshmiinfra.com</p>
          </div>
          <div className="sidebar-contact-item">
            <div className="icon-box">
              <FaPhone />
            </div>
            <p>+918595543869</p>
          </div>

          <button
            className="sidebar-btn"
            onClick={() => {
              navigate("/submit-property");
              closeMenu();
            }}
          >
            Submit Property
          </button>

          <div className="sidebar-socials">
            {SOCIALS.map(({ icon, href, label }) => (
              <a
                key={label}
                href={href}
                target="_blank"
                rel="noreferrer"
                aria-label={label}
              >
                {icon}
              </a>
            ))}
          </div>
        </div>
      </div>
    </>
  );
}
