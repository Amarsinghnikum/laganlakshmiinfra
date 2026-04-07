import React from 'react';

const About = () => {
  return (
    <div>
      {/* Breadcrumb */}
      <section className="py-20 bg-gradient-to-r from-gray-100 to-gray-200">
        <div className="container mx-auto px-4 text-center">
          <h1 className="text-5xl font-bold mb-4">About Lagan Lakshmi Infra</h1>
          <nav className="text-gray-600">
            <a href="/" className="hover:text-primary">Home</a> / About
          </nav>
        </div>
      </section>

      {/* About Content */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-4xl font-bold mb-6">Your Trusted Real Estate Partner</h2>
              <p className="text-xl text-gray-600 mb-8 leading-relaxed">
                Lagan Lakshmi Infra is a premier real estate company specializing in residential and commercial properties.
                We focus on transparency, verified listings, and expert guidance to make your property journey smooth and reliable.
              </p>
              <div className="space-y-6">
                <div className="flex items-start space-x-4">
                  <div className="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0 mt-1">
                    1
                  </div>
                  <div>
                    <h3 className="font-bold text-2xl mb-2">Verified Listings</h3>
                    <p>All properties are verified by our expert team</p>
                  </div>
                </div>
                <div className="flex items-start space-x-4">
                  <div className="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0 mt-1">
                    2
                  </div>
                  <div>
                    <h3 className="font-bold text-2xl mb-2">Expert Guidance</h3>
                    <p>Professional advice for buying, selling, and renting</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="relative">
              <img src="/assets/img/about-us.jpg" alt="About Us" className="rounded-2xl shadow-2xl w-full h-96 object-cover" />
            </div>
          </div>
        </div>
      </section>

      {/* Stats */}
      <section className="py-20 bg-primary text-white">
        <div className="container mx-auto px-4">
          <div className="grid md:grid-cols-4 gap-8 text-center">
            <div>
              <div className="text-4xl font-bold mb-2">500+</div>
              <div>Properties Listed</div>
            </div>
            <div>
              <div className="text-4xl font-bold mb-2">100+</div>
              <div>Happy Clients</div>
            </div>
            <div>
              <div className="text-4xl font-bold mb-2">5+</div>
              <div>Years Experience</div>
            </div>
            <div>
              <div className="text-4xl font-bold mb-2">24/7</div>
              <div>Support</div>
            </div>
          </div>
        </div>
      </section>

      {/* Team Placeholder */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold mb-4">Our Team</h2>
            <p>Meet the experts behind Lagan Lakshmi Infra</p>
          </div>
          {/* Team cards */}
        </div>
      </section>
    </div>
  );
};

export default About;
