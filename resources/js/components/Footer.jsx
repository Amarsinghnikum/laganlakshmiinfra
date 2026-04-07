import React from 'react';
import { Link } from 'react-router-dom';

const Footer = () => {
  return (
    <footer className="bg-gray-900 text-white py-12 mt-12">
      <div className="container mx-auto px-4">
        <div className="grid md:grid-cols-4 gap-8">
          {/* Company Info */}
          <div>
            <h3 className="text-xl font-bold mb-4">Lagan Lakshmi Infra</h3>
            <p className="mb-4">Trusted real estate company offering verified residential and commercial properties with transparent dealings and expert guidance.</p>
            <div className="flex space-x-4">
              {/* Social links placeholder */}
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="font-bold mb-4">Quick Links</h4>
            <ul className="space-y-2">
              <li><Link to="/properties" className="hover:text-primary transition">Properties</Link></li>
              <li><Link to="/about" className="hover:text-primary transition">About Us</Link></li>
              <li><Link to="/contact-us" className="hover:text-primary transition">Contact</Link></li>
              <li><Link to="/privacy-policy" className="hover:text-primary transition">Privacy Policy</Link></li>
            </ul>
          </div>

          {/* Legal */}
          <div>
            <h4 className="font-bold mb-4">Legal</h4>
            <ul className="space-y-2">
              <li><Link to="/terms-conditions" className="hover:text-primary transition">Terms & Conditions</Link></li>
              <li><Link to="/data-safety" className="hover:text-primary transition">Data Safety</Link></li>
              <li><Link to="/data-deletion" className="hover:text-primary transition">Data Deletion</Link></li>
            </ul>
          </div>

          {/* Newsletter */}
          <div>
            <h4 className="font-bold mb-4">Newsletter</h4>
            <p className="mb-4">Subscribe for latest property listings and market updates.</p>
            <div className="flex">
              <input type="email" placeholder="Your email" className="flex-1 px-4 py-2 rounded-l-lg border border-gray-600 focus:outline-none focus:border-primary" />
              <button className="bg-primary px-6 py-2 rounded-r-lg hover:bg-blue-600 transition whitespace-nowrap">Subscribe</button>
            </div>
            <p className="text-xs mt-2 opacity-75">No spam guaranteed</p>
          </div>
        </div>
        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-sm opacity-75">
          © 2024 Lagan Lakshmi Infra. All rights reserved.
        </div>
      </div>
    </footer>
  );
};

export default Footer;
