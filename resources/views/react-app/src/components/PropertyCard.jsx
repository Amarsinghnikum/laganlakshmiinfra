import "../assets/css/PropertyCard.css";
import { FaHeart, FaMapMarkerAlt, FaCar } from "react-icons/fa";
import { MdSquareFoot } from "react-icons/md";
import { IoBed } from "react-icons/io5";
import { FaShower } from "react-icons/fa";
import pb1 from "../assets/img/property/posted-by/pb-1.jpg";

export default function PropertyCard({
  image,
  title,
  location,
  sqft = "2,283",
  beds = "03",
  baths = "03",
  parking = "02",
  agentImg = pb1,
  agentName = "Ashton Kutcher",
  agentPhone = "123-455-688",
  badge = "FOR RENT",
}) {
  return (
    <div className="pc-card">
      {/* ── Image ── */}
      <div className="pc-image" style={{ backgroundImage: `url(${image})` }}>
        <span className="pc-badge">{badge}</span>
      </div>

      {/* ── Body ── */}
      <div className="pc-body">
        {/* Contact + Heart row */}
        <div className="pc-actions">
          <button className="pc-contact-btn">contact us</button>
          <button className="pc-heart-btn" aria-label="Save property">
            <FaHeart />
          </button>
        </div>

        {/* Title */}
        <h5 className="pc-title">{title}</h5>

        {/* Location */}
        <p className="pc-location">
          <FaMapMarkerAlt className="pc-loc-icon" />
          {location}
        </p>

        {/* Specs grid */}
        <div className="pc-specs">
          <div className="pc-spec-item">
            <MdSquareFoot className="pc-spec-icon" />
            <span>{sqft} sqft</span>
          </div>
          <div className="pc-spec-item">
            <IoBed className="pc-spec-icon" />
            <span>{beds}</span>
          </div>
          <div className="pc-spec-item">
            <FaShower className="pc-spec-icon" />
            <span>{baths}</span>
          </div>
          <div className="pc-spec-item">
            <FaCar className="pc-spec-icon" />
            <span>{parking}</span>
          </div>
        </div>

        {/* Divider */}
        <div className="pc-divider" />

        {/* Agent row */}
        <div className="pc-agent">
          <img src={agentImg} alt={agentName} className="pc-agent-img" />
          <span className="pc-agent-name">{agentName}</span>
          <span className="pc-agent-phone">{agentPhone}</span>
        </div>
      </div>
    </div>
  );
}
