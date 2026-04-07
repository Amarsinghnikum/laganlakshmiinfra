import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { Menu, X } from 'lucide-react';
import { FaSearch } from 'react-icons/fa';

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${isScrolled ? 'bg-white shadow-lg' : 'bg-transparent'}`}>
      <div className="container mx-auto px-4 py-4">
        <div className="flex justify-between items-center">
          {/* Logo */}
          <Link to="/" className="text-2xl font-bold text-primary">
            Lagan Lakshmi Infra
          </Link>

          {/* Desktop Nav */}
          <nav className="hidden md:flex items-center space-x-6">
            <Link to="/" className="hover:text-primary transition">Home</Link>
            <Link to="/properties" className="hover:text-primary transition">Properties</Link>
            <Link to="/about" className="hover:text-primary transition">About</Link>
            <Link to="/contact-us" className="hover:text-primary transition">Contact</Link>
            <a href="/login" className="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition ml-4">Submit Property</a>
          </nav>

          {/* Mobile Menu Button */}
          <button onClick={() => setIsMenuOpen(!isMenuOpen)} className="md:hidden">
            {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Menu */}
        {isMenuOpen && (
          <nav className="md:hidden mt-4 pt-4 border-t">
            <Link to="/" className="block py-2 hover:text-primary">Home</Link>
            <Link to="/properties" className="block py-2 hover:text-primary">Properties</Link>
            <Link to="/about" className="block py-2 hover:text-primary">About</Link>
            <Link to="/contact-us" className="block py-2 hover:text-primary">Contact</Link>
            <a href="/login" className="block py-2 bg-primary text-white px-4 py-2 rounded-lg mt-2 inline-block">Submit Property</a>
          </nav>
        )}
      </div>
    </header>
  );
};

export default Header;
