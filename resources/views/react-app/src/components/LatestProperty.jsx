import { useEffect, useState } from "react";
import PropertyCard from "./PropertyCard";

const API_URL = "/proxy/featured-listings";

// Safely derive display fields from the API shape (defensive defaults)
export const mapListingToCard = (item = {}) => {
  const image =
    item.image ||
    item.thumbnail ||
    item.cover_image ||
    item.featured_image ||
    item.main_image;

  const imageUrl =
    typeof image === "string" && image.length
      ? image.startsWith("http")
        ? image
        : `https://laganlakshmiinfra.com${image.startsWith("/") ? "" : "/"}${image}`
      : "/assets/img/property/property-1.jpg";

  return {
    id: item.id || item.slug || Math.random().toString(36).slice(2),
    image: imageUrl,
    title: item.title || item.name || "Featured Property",
    location: item.location || item.city || item.address || "Location",
    sqft: item.area_sqft || item.size || item.plot_area || "—",
    beds: item.bedrooms || item.beds || "—",
    baths: item.bathrooms || item.baths || "—",
    parking: item.parking || item.parking_spaces || "—",
    badge:
      (item.status || item.purpose || item.type || "Featured")
        .toString()
        .toUpperCase(),
  };
};

// Normalize different backend shapes into an array of listings
export const extractListings = (payload) => {
  if (Array.isArray(payload)) return payload;
  if (Array.isArray(payload?.data)) return payload.data;
  if (Array.isArray(payload?.data?.data)) return payload.data.data;
  if (Array.isArray(payload?.listings)) return payload.listings;
  return [];
};

export default function LatestProperty() {
  const [listings, setListings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    let isMounted = true;
    const fetchListings = async () => {
      try {
        const res = await fetch(API_URL, { mode: "cors" });
        if (!res.ok) throw new Error(`API returned ${res.status}`);
        const data = await res.json();
        console.log("Featured listings response:", data); // debug for console
        if (isMounted) {
          const mapped = extractListings(data).map(mapListingToCard);
          setListings(mapped);
        }
      } catch (err) {
        console.error("Featured listings fetch error:", err);
        if (isMounted) setError("Could not load featured listings right now.");
      } finally {
        if (isMounted) setLoading(false);
      }
    };
    fetchListings();
    return () => {
      isMounted = false;
    };
  }, []);

  const fallback = [
    mapListingToCard({
      title: "Godrej Palm Retreat",
      location: "Noida",
      image: "/assets/img/property/property-1.jpg",
    }),
    mapListingToCard({
      title: "DLF King's Court",
      location: "Delhi",
      image: "/assets/img/property/property-2.jpg",
    }),
    mapListingToCard({
      title: "Lodha World One",
      location: "Mumbai",
      image: "/assets/img/property/property-3.jpg",
    }),
  ];

  const cards = !loading && !error && listings.length ? listings : fallback;

  return (
    <section className="property-section spad">
      <div className="container">
        <div className="section-title">
          <h4>Latest Property</h4>
          {loading && <small style={{ color: "#6b7280" }}>Loading…</small>}
          {!loading && error && (
            <small style={{ color: "#ef4444" }}>{error}</small>
          )}
        </div>

        <div className="row">
          {cards.map((item) => (
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
