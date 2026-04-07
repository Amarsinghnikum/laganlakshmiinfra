 import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { fetchProperties, fetchPropertyTypes, fetchStates } from '../services/api.js';
import { ChevronLeft, ChevronRight, Search } from 'lucide-react';

const Properties = () => {
  const [properties, setProperties] = useState([]);
  const [propertyTypes, setPropertyTypes] = useState([]);
  const [states, setStates] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filters, setFilters] = useState({ type: '', state: '', price: '' });

  useEffect(() => {
    const loadData = async () => {
      try {
        const [propsRes, typesRes, statesRes] = await Promise.all([
          fetchProperties(),
          fetchPropertyTypes(),
          fetchStates()
        ]);
        setProperties(propsRes.data.data || propsRes.data || []);
        setPropertyTypes(typesRes.data.data || typesRes.data || []);
        setStates(statesRes.data.data || statesRes.data || []);
      } catch (error) {
        console.error('Error loading properties:', error);
      } finally {
        setLoading(false);
      }
    };
    loadData();
  }, []);

  const filteredProperties = properties.filter(property => {
    const typeMatch = !filters.type || property.property_type_id == filters.type;
    const stateMatch = !filters.state || property.state_id == filters.state;
    return typeMatch && stateMatch;
  });

  return (
    <div>
      {/* Breadcrumb */}
      <section className="py-20 bg-gray-100">
        <div className="container mx-auto px-4 text-center">
          <h1 className="text-5xl font-bold mb-4">Properties</h1>
          <nav> <Link to="/" className="hover:text-primary">Home</Link> / Properties </nav>
        </div>
      </section>

      {/* Filters */}
      <section className="py-16">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">
            <div className="grid md:grid-cols-4 gap-6 mb-12">
              <div className="md:col-span-2">
                <div className="relative">
                  <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" size={20} />
                  <input 
                    type="text" 
                    placeholder="Search properties by location, name..." 
                    className="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:outline-none transition" 
                  />
                </div>
              </div>
              <select 
                value={filters.type} 
                onChange={(e) => setFilters({...filters, type: e.target.value})}
                className="p-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:outline-none transition"
              >
                <option value="">All Types</option>
                {propertyTypes.map(type => (
                  <option key={type.id} value={type.id}>{type.name}</option>
                ))}
              </select>
              <select 
                value={filters.state} 
                onChange={(e) => setFilters({...filters, state: e.target.value})}
                className="p-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:outline-none transition"
              >
                <option value="">All States</option>
                {states.map(state => (
                  <option key={state.id} value={state.id}>{state.name}</option>
                ))}
              </select>
            </div>
          </div>
        </div>
      </section>

      {/* Properties Grid */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          {loading ? (
            <div className="text-center py-20">
              <div className="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
              <p className="mt-4 text-xl text-gray-600">Loading properties...</p>
            </div>
          ) : (
            <>
              <div className="flex justify-between items-center mb-12">
                <h2 className="text-4xl font-bold">Available Properties ({filteredProperties.length})</h2>
                <Link to="/submit-property" className="bg-primary text-white px-8 py-3 rounded-xl hover:bg-blue-600 transition font-semibold">
                  Add Your Property
                </Link>
              </div>
              <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {filteredProperties.map((property) => (
                  <Link key={property.id} to={`/property-details/${property.id}`} className="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div className="h-64 bg-gradient-to-br from-gray-200 to-gray-300 group-hover:from-primary/10 relative overflow-hidden">
                      <img 
                        src={property.images?.[0] || '/assets/img/property-placeholder.jpg'} 
                        alt={property.title}
                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                      />
                      <div className="absolute top-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-sm">
                        Featured
                      </div>
                    </div>
                    <div className="p-8">
                      <div className="flex items-baseline justify-between mb-3">
                        <h3 className="text-2xl font-bold group-hover:text-primary transition">{property.title}</h3>
                        <span className="text-2xl font-bold text-primary">₹{property.price}</span>
                      </div>
                      <p className="text-gray-600 mb-4 line-clamp-2">{property.description}</p>
                      <div className="grid grid-cols-3 gap-4 mb-6 text-sm">
                        <div className="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                          <span className="font-bold text-lg">{property.bhk || '3'}</span>
                          <span>BHK</span>
                        </div>
                        <div className="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                          <span className="font-bold text-lg">{property.sqft || '1200'}</span>
                          <span>Sqft</span>
                        </div>
                        <div className="flex flex-col items-center p-3 bg-gray-50 rounded-xl">
                          <span className="font-bold">{property.city?.name || 'Mumbai'}</span>
                          <span>Location</span>
                        </div>
                      </div>
                      <div className="flex items-center justify-between pt-4 border-t">
                        <span className="text-sm text-gray-500">Verified Listing</span>
                        <span className="font-semibold text-primary group-hover:underline">View Details →</span>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
              {filteredProperties.length === 0 && !loading && (
                <div className="text-center py-20">
                  <p className="text-2xl text-gray-500 mb-4">No properties found matching your criteria.</p>
                  <button 
                    onClick={() => setFilters({ type: '', state: '', price: '' })}
                    className="bg-primary text-white px-8 py-3 rounded-xl hover:bg-blue-600 transition font-semibold"
                  >
                    Clear Filters
                  </button>
                </div>
              )}
            </>
          )}
        </div>
      </section>
    </div>
  );
};

export default Properties;
