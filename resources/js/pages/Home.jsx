import React from 'react';
import { Link } from 'react-router-dom';

const featuredList = [
  {
    id: 1,
    title: 'Luxury 3BHK Apartment',
    price: '1.25 Cr',
    location: 'Baner, Pune',
    image: '/assets/img/property-placeholder.jpg',
  },
  {
    id: 2,
    title: 'Modern Office Space',
    price: '₹8,500/sqft',
    location: 'MG Road, Bangalore',
    image: '/assets/img/property-placeholder.jpg',
  },
  {
    id: 3,
    title: 'Premium Villa Retreat',
    price: '2.8 Cr',
    location: 'Khandala, Maharashtra',
    image: '/assets/img/property-placeholder.jpg',
  },
];

const Home = () => {

  return (
    <div>
      {/* Hero Section */}
      <section className="bg-gradient-to-r from-blue-600 to-primary text-white py-32 text-center relative overflow-hidden">
        <div className="container mx-auto px-4">
          <h1 className="text-5xl md:text-6xl font-bold mb-6">Find Your Dream Property</h1>
          <p className="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Discover verified residential & commercial properties with expert guidance.</p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link to="/properties" className="bg-white text-primary px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition text-lg">Browse Properties</Link>
            <a href="/login" className="border-2 border-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary transition text-lg">Submit Property</a>
          </div>
        </div>
      </section>

      {/* Featured Properties */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold mb-4">Featured Properties</h2>
            <p className="text-xl text-gray-600 max-w-2xl mx-auto">Handpicked listings from verified developers across prime locations.</p>
          </div>
          <div className="grid md:grid-cols-3 gap-8">
            {featuredList.map((property) => (
              <div key={property.id} className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow">
                <img src={property.image || '/assets/img/property-placeholder.jpg'} alt={property.title} className="w-full h-64 object-cover" />
                <div className="p-6">
                  <div className="flex items-baseline justify-between mb-2">
                    <h3 className="text-2xl font-bold">{property.title}</h3>
                    <span className="bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold">{property.price}</span>
                  </div>
                  <p className="text-gray-600 mb-4">{property.location}</p>
                  <Link to={`/property-details/${property.id}`} className="text-primary font-semibold hover:underline">View Details →</Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter */}
      <section className="py-20 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div className="container mx-auto px-4 text-center">
          <h2 className="text-4xl font-bold mb-6">Stay Updated</h2>
          <p className="text-xl mb-8 max-w-2xl mx-auto">Subscribe to receive the latest property listings, market updates, and exclusive offers.</p>
          <div className="max-w-md mx-auto flex">
            <input type="email" placeholder="Enter your email" className="flex-1 px-6 py-4 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary" />
            <button className="bg-primary px-8 py-4 rounded-r-lg hover:bg-blue-600 font-semibold whitespace-nowrap">Subscribe Now</button>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
