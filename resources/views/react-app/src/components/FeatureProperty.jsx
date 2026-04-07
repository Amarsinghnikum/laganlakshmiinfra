import {
  FaBed,
  FaBath,
  FaCar,
  FaRulerCombined,
  FaMapMarkerAlt,
} from "react-icons/fa";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "../assets/css/featureProperty.css";
import fp1 from "../assets/img/feature-property/fp-1.jpg";

export default function FeatureProperty() {
  return (
    <section className="feature-property-section">
      <div className="container feature-wrapper">
        {/* LEFT PANEL */}
        <div className="feature-left">
          <h2>FEATURE PROPERTY</h2>

          <ul className="feature-category">
            <li>Apartment</li>
            <li>House</li>
            <li>Office</li>
            <li>Hotel</li>
            <li>Villa</li>
            <li>Restaurant</li>
          </ul>

          <button className="view-property-btn">VIEW ALL PROPERTY</button>
        </div>

        {/* RIGHT SLIDER */}
        <div className="feature-right">
          <Swiper
            modules={[Navigation]}
            navigation
            loop
            className="feature-slider"
          >
            <SwiperSlide>
              <div
                className="feature-slide"
                style={{
                  backgroundImage: `url(${fp1})`,
                }}
              >
                <div className="feature-overlay">
                  <h3>Total Environment Pursuit of Radical Rhapsody</h3>

                  <p className="location">
                    <FaMapMarkerAlt /> ITPL Main Rd, Whitefield, Bangalore
                  </p>

                  <div className="feature-buttons">
                    <span className="rent-btn">FOR RENT</span>
                    <button className="contact-btn">contact us</button>
                  </div>

                  <div className="feature-details">
                    <span>
                      <FaRulerCombined /> 2,753 sqft
                    </span>
                    <span>
                      <FaBed /> 03
                    </span>
                    <span>
                      <FaBath /> 03
                    </span>
                    <span>
                      <FaCar /> 02
                    </span>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          </Swiper>
        </div>
      </div>
    </section>
  );
}
