import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { submitContact } from '../services/api.js';
import { Phone, Mail, MapPin, Send } from 'lucide-react';

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    message: ''
  });
  const [status, setStatus] = useState({ type: '', message: '' });
  const [submitting, setSubmitting] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setSubmitting(true);
    setStatus({ type: '', message: '' });

    try {
      await submitContact(formData);
      setStatus({ type: 'success', message: 'Thank you! Your message has been sent. We\'ll get back to you soon.' });
      setFormData({ name: '', email: '', phone: '', message: '' });
    } catch (error) {
      setStatus({ type: 'error', message: error.response?.data?.message || 'Something went wrong. Please try again.' });
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div>
      {/* Breadcrumb */}
      <section className="py-20 bg-gradient-to-r from-blue-600 to-primary text-white text-center">
        <div className="container mx-auto px-4">
          <h1 className="text-5xl font-bold mb-4">Contact Us</h1>
          <nav className="opacity-90">
            <Link to="/" className="hover:underline">Home</Link> / Contact
          </nav>
        </div>
      </section>

      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            {/* Contact Info */}
            <div>
              <h2 className="text-4xl font-bold mb-8">Get In Touch</h2>
              <p className="text-xl text-gray-600 mb-12 leading-relaxed">
                Have questions about buying, renting, or listing a property? 
                Fill out the form below and our team will get back to you within 24 hours.
              </p>

              <div className="space-y-8 mb-12">
                <div className="flex items-start space-x-4 p-6 bg-gray-50 rounded-xl">
                  <Phone className="mt-1 text-primary" size={24} />
                  <div>
                    <h4 className="font-bold text-xl mb-1">Phone</h4>
                    <p>+91 98765 43210</p>
                  </div>
                </div>
                <div className="flex items-start space-x-4 p-6 bg-gray-50 rounded-xl">
                  <Mail className="mt-1 text-primary" size={24} />
                  <div>
                    <h4 className="font-bold text-xl mb-1">Email</h4>
                    <p>info@laganlakshmiinfra.com</p>
                  </div>
                </div>
                <div className="flex items-start space-x-4 p-6 bg-gray-50 rounded-xl">
                  <MapPin className="mt-1 text-primary" size={24} />
                  <div>
                    <h4 className="font-bold text-xl mb-1">Address</h4>
                    <p>Mumbai, Maharashtra<br />India - 400001</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Contact Form */}
            <div className="bg-white rounded-2xl shadow-2xl p-12">
              {status.message && (
                <div className={`mb-8 p-4 rounded-xl font-semibold ${
                  status.type === 'success' 
                    ? 'bg-green-100 text-green-800 border border-green-300' 
                    : 'bg-red-100 text-red-800 border border-red-300'
                }`}>
                  {status.message}
                </div>
              )}
              <form onSubmit={handleSubmit} className="space-y-6">
                <div>
                  <label className="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                  <input
                    type="text"
                    name="name"
                    value={formData.name}
                    onChange={handleChange}
                    required
                    className="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                  />
                </div>
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                    <input
                      type="email"
                      name="email"
                      value={formData.email}
                      onChange={handleChange}
                      required
                      className="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    />
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                    <input
                      type="tel"
                      name="phone"
                      value={formData.phone}
                      onChange={handleChange}
                      className="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    />
                  </div>
                </div>
                <div>
                  <label className="block text-sm font-semibold text-gray-700 mb-2">Message *</label>
                  <textarea
                    name="message"
                    rows="5"
                    value={formData.message}
                    onChange={handleChange}
                    required
                    className="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition resize-vertical"
                    placeholder="Tell us about your property needs..."
                  ></textarea>
                </div>
                <button 
                  type="submit" 
                  disabled={submitting}
                  className="w-full flex items-center justify-center space-x-3 bg-primary text-white py-5 px-6 rounded-xl hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all font-semibold text-lg shadow-lg hover:shadow-xl"
                >
                  <Send size={20} />
                  <span>{submitting ? 'Sending...' : 'Send Message'}</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Contact;
