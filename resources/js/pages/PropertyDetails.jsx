import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import { ChevronLeft, Share2, Heart } from 'lucide-react';

const PropertyDetails = () => {
  const { id } = useParams();
  const [property, setProperty] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Fetch specific property - placeholder (add to api.js later)
    const fetchProperty = async () => {
      try {
        // const response = await api.get(`/listings/${id}`);
        // setProperty(response.data);
        setProperty({
          id,
          title: 'Luxury 3BHK Apartment in Prime Mumbai Location',
          price: '₹2.5 Cr',
          images: ['/assets/img/property/slider/ps-1.jpg', '/assets/img/property/slider/ps-2.jpg'],
          description: 'Spacious 3BHK apartment with modern amenities in heart of Mumbai. Perfect for families.',
          sqft: 1800,
          bhk: 3,
          location: 'Bandra West, Mumbai',
          bedrooms: 3,
          bathrooms: 3,
          parking: 2,
          yearBuilt: 2023,
          features: ['Gym', 'Pool', '24/7 Security', 'Power Backup']
        });
      } catch (error) {
        console.error('Error fetching property:', error);
      } finally {
        setLoading(false);
      }
    };
    fetchProperty();
  }, [id]);

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
          <p>Loading property details...</p>
        </div>
      </div>
    );
  }

  if (!property) {
    return <div>Property not found</div>;
  }

  return (
    <div>
      {/* Breadcrumb */}
      <section className="py-12 bg-gray-100 border-b">
        <div className="container mx-auto px-4">
          <nav className="flex items-center space-x-2 text-gray-600">
            <Link to="/" className="hover:text-primary">Home</Link>
            <ChevronLeft size={20} className="mx-1" />
            <Link to="/properties" className="hover:text-primary">Properties</Link>
            <ChevronLeft size={20} className="mx-1" />
            <span>{property.title}</span>
          </nav>
        </div>
      </section>

      {/* Property Gallery */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-12">
            {/* Main Image */}
            <div className="space-y-4">
              <img 
                src={property.images[0]} 
                alt={property.title}
                className="w-full h-96 object-cover rounded-2xl shadow-2xl"
              />
              {/* Thumbnails */}
              <div className="flex gap-2">
                {property.images.slice(1).map((img, idx) => (
                  <img 
                    key={idx}
                    src={img} 
                    alt={`Thumbnail ${idx}`}
                    className="w-24 h-24 object-cover rounded-xl cursor-pointer hover:ring-4 ring-primary/30 transition flex-shrink-0"
                  />
                ))}
              </div>
            </div>

            {/* Property Info */}
            <div className="space-y-8">
              <div>
                <div className="flex items-start justify-between mb-4">
                  <h1 className="text-4xl font-bold">{property.title}</h1>
                  <div className="flex space-x-4 pt-2">
                    <button className="p-3 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                      <Heart size={20} />
                    </button>
                    <button className="p-3 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                      <Share2 size={20} />
                    </button>
                  </div>
                </div>
                <div className="text-4xl font-bold text-primary mb-2">{property.price}</div>
                <div className="flex items-center space-x-8 text-sm text-gray-600">
                  <span>{property.sqft} sqft</span>
                  <span>{property.bhk} BHK</span>
                  <span>{property.bedrooms} Beds</span>
                  <span>{property.bathrooms} Baths</span>
                </div>
              </div>

              <div className="bg-gray-50 rounded-xl p-8">
                <h3 className="text-2xl font-bold mb-6">Property Highlights</h3>
                <div className="grid md:grid-cols-2 gap-4">
                  <div className="flex items-center space-x-3 p-4 bg-white rounded-lg shadow-sm">
                    <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                      <MapPin size={20} className="text-primary" />
                    </div>
                    <div>
                      <h4 className="font-semibold">Location</h4>
                      <p className="text-gray-600">{property.location}</p>
                    </div>
                  </div>
                  {property.features.map((feature, idx) => (
                    <div key={idx} className="flex items-center space-x-3 p-4 bg-white rounded-lg shadow-sm">
                      <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span className="text-green-600 font-semibold">✓</span>
                      </div>
                      <div>
                        <h4 className="font-semibold">{feature}</h4>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              <div className="flex flex-col sm:flex-row gap-4">
                <Link 
                  to="/contact-us" 
                  className="flex-1 bg-primary text-white py-5 px-8 rounded-xl hover:bg-blue-600 transition font-semibold text-center shadow-xl"
                >
                  Contact Agent
                </Link>
                <button className="px-8 py-5 border-2 border-gray-300 rounded-xl hover:border-primary hover:text-primary transition font-semibold">
                  Save Property
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Description */}
      <section className="py-20 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto">
            <h2 className="text-3xl font-bold mb-8">Property Description</h2>
            <p className="text-lg text-gray-700 leading-relaxed whitespace-pre-wrap">
              {property.description}
            </p>
          </div>
        </div>
      </section>
    </div>
  );
};

export default PropertyDetails;
