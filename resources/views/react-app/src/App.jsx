import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./page/Home";
import About from "./page/AboutUs";
import Properties from "./page/Properties";
import Contact from "./page/Contact";
import PrivacyPolicy from "./page/PrivacyPolicy";
import TermsAndConditions from "./page/TermsAndConditions";
import PostPropertyScreen from "./page/PostProperty";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/properties" element={<Properties />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/terms-and-conditions" element={<TermsAndConditions />} />
        <Route path="/privacy-policy" element={<PrivacyPolicy />} />
        <Route path="/submit-property" element={<PostPropertyScreen />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
