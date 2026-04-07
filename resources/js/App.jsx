import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Header from './components/Header.jsx';
import Footer from './components/Footer.jsx';
import Home from './pages/Home.jsx';
import About from './pages/About.jsx';
import Properties from './pages/Properties.jsx';
import PropertyDetails from './pages/PropertyDetails.jsx';
import Contact from './pages/Contact.jsx';
import PrivacyPolicy from './pages/PrivacyPolicy.jsx';
import TermsConditions from './pages/TermsConditions.jsx';
import DataSafety from './pages/DataSafety.jsx';
import DataDeletion from './pages/DataDeletion.jsx';

function App() {
  return (
    <Router>
      <div className="min-h-screen flex flex-col">
        <Header />
        <main className="flex-grow">
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/properties" element={<Properties />} />
            <Route path="/property-details" element={<PropertyDetails />} />
            <Route path="/property-details/:id" element={<PropertyDetails />} />
            <Route path="/contact-us" element={<Contact />} />
            <Route path="/privacy-policy" element={<PrivacyPolicy />} />
            <Route path="/terms-conditions" element={<TermsConditions />} />
            <Route path="/data-safety" element={<DataSafety />} />
            <Route path="/data-deletion" element={<DataDeletion />} />
            <Route path="*" element={<div>404 - Page Not Found</div>} />
          </Routes>
        </main>
        <Footer />
      </div>
    </Router>
  );
}

export default App;
