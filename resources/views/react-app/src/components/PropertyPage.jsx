import { useEffect, useState } from "react";
import { NavLink } from "react-router-dom";
import { FaHome, FaChevronRight } from "react-icons/fa";
import PropertyCard from "./PropertyCard";
import "../assets/css/PropertyPage.css";
import { mapListingToCard, extractListings } from "./LatestProperty";

import heroBg from "../assets/img/hero/hero-2.jpg";

const PAGE_SIZE = 6;
const API_URL = "/proxy/featured-listings";

export default function PropertiesPage() {
  const [visible, setVisible] = useState(PAGE_SIZE);
  const [properties, setProperties] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const showLoadMore = visible < properties.length;

  useEffect(() => {
    let active = true;
    const load = async () => {
      try {
        const res = await fetch(API_URL, { mode: "cors" });
        if (!res.ok) throw new Error(`API returned ${res.status}`);
        const data = await res.json();
        console.log("PropertiesPage featured response:", data);
        if (!active) return;
        const mapped = extractListings(data).map(mapListingToCard);
        setProperties(mapped);
      } catch (err) {
        console.error("PropertiesPage fetch error:", err);
        if (active) setError("Could not load properties.");
      } finally {
        if (active) setLoading(false);
      }
    };
    load();
    return () => {
      active = false;
    };
  }, []);

  return (
    <div className="pp-page">
      {/* ── Hero Banner ── */}
      <div className="pp-hero" style={{ backgroundImage: `url(${heroBg})` }}>
        <div className="pp-breadcrumb">
          <h2>PROPERTY GRID</h2>
          <div className="pp-trail">
            <FaHome className="pp-trail-home" />
            <NavLink to="/" className="pp-trail-link">
              Home
            </NavLink>
            <FaChevronRight className="pp-trail-arrow" />
            <span className="pp-trail-current">Property</span>
          </div>
        </div>
      </div>

      {/* ── Main Content ── */}
      <section className="pp-content">
        <div className="container">
          {/* Section title */}
          <div className="pp-section-title">
            <h4>PROPERTY GRID</h4>
            {loading && <small style={{ color: "#6b7280" }}>Loading…</small>}
            {!loading && error && (
              <small style={{ color: "#ef4444" }}>{error}</small>
            )}
          </div>

          {/* Cards grid */}
          <div className="pp-grid">
            {properties.slice(0, visible).map((prop) => (
              <PropertyCard
                key={prop.id}
                image={prop.image}
                badge={prop.badge}
                badgeColor={prop.badgeColor}
                title={prop.title}
                location={prop.location}
                sqft={prop.sqft}
                beds={prop.beds}
                baths={prop.baths}
                parking={prop.parking}
                agentImg={prop.agentImg}
                agentName={prop.agentName}
                agentPhone={prop.agentPhone}
              />
            ))}
          </div>

          {/* Load More */}
          {showLoadMore && (
            <div className="pp-loadmore">
              <button
                className="pp-loadmore-btn"
                onClick={() => setVisible((v) => v + PAGE_SIZE)}
              >
                LOAD MORE
              </button>
            </div>
          )}
        </div>
      </section>
    </div>
  );
}
