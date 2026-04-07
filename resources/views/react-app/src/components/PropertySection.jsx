import { useEffect, useState } from "react";
import PropertyCard from "./PropertyCard";
import "../assets/css/PropertySection.css";
import { mapListingToCard, extractListings } from "./LatestProperty";

const API_URL = "/proxy/featured-listings";

export default function PropertySection() {
  const [listings, setListings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    let active = true;
    const load = async () => {
      try {
        const res = await fetch(API_URL, { mode: "cors" });
        if (!res.ok) throw new Error(`API returned ${res.status}`);
        const data = await res.json();
        console.log("PropertySection featured response:", data);
        if (!active) return;
        const mapped = extractListings(data).map(mapListingToCard);
        setListings(mapped);
      } catch (err) {
        console.error("PropertySection fetch error:", err);
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

  const fallback = listings.length === 0;

  return (
    <section className="property-section">
      <div className="container">
        <div className="section-title">
          <h4>Latest Property</h4>
          {loading && <small style={{ color: "#6b7280" }}>Loading…</small>}
          {!loading && error && (
            <small style={{ color: "#ef4444" }}>{error}</small>
          )}
        </div>

        <div className="property-grid">
          {(fallback ? [] : listings).map((item) => (
            <PropertyCard
              key={item.id}
              image={item.image}
              title={item.title}
              location={item.location}
              sqft={item.sqft}
              beds={item.beds}
              baths={item.baths}
              parking={item.parking}
              badge={item.badge}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
