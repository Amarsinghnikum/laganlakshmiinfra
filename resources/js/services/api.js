import axios from 'axios';

const api = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
});

// Add CSRF token for POST/PUT/DELETE
api.interceptors.request.use((config) => {
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                localStorage.getItem('csrf-token');
  if (token) {
    config.headers['X-CSRF-TOKEN'] = token;
  }
  return config;
});

export default api;

export const fetchProperties = () => api.get('/listings');
export const fetchFeatured = () => api.get('/listings/featured');
export const fetchPropertyTypes = () => api.get('/property-types');
export const fetchStates = () => api.get('/states');
export const fetchCities = (stateId) => api.get(`/states/${stateId}/cities`);

export const submitContact = (data) => api.post('/contact-submit', data); // Reuse Laravel route
export const subscribeNewsletter = (email) => api.post('/newsletter/store', { email });
