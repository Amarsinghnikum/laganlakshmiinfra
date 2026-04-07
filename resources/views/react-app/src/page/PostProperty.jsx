import { useState, useEffect, useRef, useCallback } from "react";

/* ─────────────────────────────────────────────────────────────
   CONSTANTS
───────────────────────────────────────────────────────────── */
const STEPS = [
  { id: 1, label: "Basic Info", icon: "📋" },
  { id: 2, label: "Location", icon: "📍" },
  { id: 3, label: "Details", icon: "🏠" },
  { id: 4, label: "Amenities", icon: "✨" },
  { id: 5, label: "Media", icon: "📷" },
  { id: 6, label: "Contact", icon: "📞" },
  { id: 7, label: "Preview", icon: "👁️" },
];

const CATEGORIES = [
  { id: 1, name: "Flat", icon: "🏢" },
  { id: 2, name: "Villa", icon: "🏡" },
  { id: 3, name: "Plot", icon: "📐" },
  { id: 4, name: "Office", icon: "🏬" },
  { id: 5, name: "Apartment", icon: "🏠" },
  { id: 6, name: "House", icon: "🏘️" },
];

const BHK = ["1 BHK", "2 BHK", "3 BHK", "4 BHK", "5 BHK", "6+ BHK"];
const BATHS = ["1", "2", "3", "4", "5+"];
const FURN = ["Furnished", "Semi-Furnished", "Unfurnished"];

const DETAILS_MAP = {
  Plot: [
    {
      key: "areaSqft",
      label: "Plot Area (sq ft)",
      type: "num",
      ph: "e.g. 2400",
    },
    {
      key: "plotLength",
      label: "Plot Length (ft)",
      type: "num",
      ph: "e.g. 60",
    },
    {
      key: "plotBreadth",
      label: "Plot Breadth (ft)",
      type: "num",
      ph: "e.g. 40",
    },
    {
      key: "boundaryWall",
      label: "Boundary Wall",
      type: "sel",
      opts: ["Yes", "No", "Partial"],
    },
    {
      key: "facing",
      label: "Facing",
      type: "sel",
      opts: ["East", "West", "North", "South", "NE", "NW", "SE", "SW"],
    },
    {
      key: "approval",
      label: "Approval",
      type: "sel",
      opts: ["Approved", "Non-Approved", "Pending"],
    },
  ],
  Villa: [
    {
      key: "areaSqft",
      label: "Built-up Area (sq ft)",
      type: "num",
      ph: "e.g. 3000",
    },
    {
      key: "plotArea",
      label: "Plot Area (sq ft)",
      type: "num",
      ph: "e.g. 5000",
    },
    { key: "bhk", label: "BHK", type: "sel", opts: BHK },
    { key: "bathrooms", label: "Bathrooms", type: "sel", opts: BATHS },
    { key: "totalFloors", label: "Total Floors", type: "num", ph: "e.g. 2" },
    { key: "furnishing", label: "Furnishing", type: "sel", opts: FURN },
  ],
  Office: [
    {
      key: "areaSqft",
      label: "Office Area (sq ft)",
      type: "num",
      ph: "e.g. 1000",
    },
    { key: "floor", label: "Floor", type: "num", ph: "e.g. 5" },
    { key: "totalFloors", label: "Total Floors", type: "num", ph: "e.g. 15" },
    {
      key: "washrooms",
      label: "Washrooms",
      type: "sel",
      opts: ["1", "2", "3", "4+"],
    },
    {
      key: "furnishing",
      label: "Furnishing",
      type: "sel",
      opts: [...FURN, "Shell"],
    },
    { key: "cabins", label: "Cabins / Rooms", type: "num", ph: "e.g. 5" },
  ],
  default: [
    { key: "areaSqft", label: "Area (sq ft)", type: "num", ph: "e.g. 1500" },
    { key: "bhk", label: "BHK", type: "sel", opts: BHK },
    { key: "bathrooms", label: "Bathrooms", type: "sel", opts: BATHS },
    { key: "floor", label: "Floor", type: "num", ph: "e.g. 3" },
    { key: "totalFloors", label: "Total Floors", type: "num", ph: "e.g. 10" },
    { key: "furnishing", label: "Furnishing", type: "sel", opts: FURN },
  ],
};

const AMENITIES_MAP = {
  Plot: [
    { id: 1, n: "Security", i: "👮" },
    { id: 2, n: "Park", i: "🌳" },
    { id: 3, n: "Green Area", i: "🌿" },
    { id: 4, n: "Water Supply", i: "💧" },
    { id: 5, n: "Electricity", i: "⚡" },
    { id: 6, n: "Boundary Wall", i: "🧱" },
    { id: 7, n: "Gated Community", i: "🚪" },
    { id: 8, n: "Street Lights", i: "💡" },
  ],
  Villa: [
    { id: 1, n: "Parking", i: "🚗" },
    { id: 2, n: "Security", i: "👮" },
    { id: 3, n: "Power Backup", i: "⚡" },
    { id: 4, n: "Water Supply", i: "💧" },
    { id: 5, n: "Garden", i: "🌳" },
    { id: 6, n: "Swimming Pool", i: "🏊" },
    { id: 7, n: "Gym", i: "🏋️" },
    { id: 8, n: "Garage", i: "🚙" },
    { id: 9, n: "Terrace", i: "🏠" },
    { id: 10, n: "CCTV Security", i: "📹" },
    { id: 11, n: "Maintenance Staff", i: "🧹" },
  ],
  Office: [
    { id: 1, n: "Parking", i: "🚗" },
    { id: 2, n: "Lift", i: "🛗" },
    { id: 3, n: "Security", i: "👮" },
    { id: 4, n: "Power Backup", i: "⚡" },
    { id: 5, n: "Water Supply", i: "💧" },
    { id: 6, n: "Central AC", i: "❄️" },
    { id: 7, n: "Reception", i: "🛎️" },
    { id: 8, n: "Conference Room", i: "📋" },
    { id: 9, n: "CCTV Security", i: "📹" },
    { id: 10, n: "Fire Safety", i: "🔥" },
    { id: 11, n: "WiFi", i: "📶" },
    { id: 12, n: "Pantry", i: "☕" },
  ],
  default: [
    { id: 1, n: "Parking", i: "🚗" },
    { id: 2, n: "Lift", i: "🛗" },
    { id: 3, n: "Security", i: "👮" },
    { id: 4, n: "Power Backup", i: "⚡" },
    { id: 5, n: "Water Supply", i: "💧" },
    { id: 6, n: "Gym", i: "🏋️" },
    { id: 7, n: "Swimming Pool", i: "🏊" },
    { id: 8, n: "Club House", i: "🏠" },
    { id: 9, n: "Garden", i: "🌳" },
    { id: 10, n: "Kids Play Area", i: "🎢" },
    { id: 11, n: "Maintenance Staff", i: "🧹" },
    { id: 12, n: "CCTV Security", i: "📹" },
  ],
};

const STATES = [
  { id: 1, name: "Maharashtra" },
  { id: 2, name: "Delhi" },
  { id: 3, name: "Karnataka" },
  { id: 4, name: "Tamil Nadu" },
  { id: 5, name: "Gujarat" },
  { id: 6, name: "Rajasthan" },
  { id: 7, name: "Uttar Pradesh" },
  { id: 8, name: "West Bengal" },
  { id: 9, name: "Telangana" },
  { id: 10, name: "Bihar" },
];
const CITIES = {
  1: [
    { id: 1, name: "Mumbai" },
    { id: 2, name: "Pune" },
    { id: 3, name: "Nagpur" },
  ],
  2: [
    { id: 4, name: "New Delhi" },
    { id: 5, name: "Noida" },
    { id: 6, name: "Gurugram" },
  ],
  3: [
    { id: 7, name: "Bengaluru" },
    { id: 8, name: "Mysuru" },
    { id: 9, name: "Hubli" },
  ],
  4: [
    { id: 10, name: "Chennai" },
    { id: 11, name: "Coimbatore" },
    { id: 12, name: "Madurai" },
  ],
  5: [
    { id: 13, name: "Ahmedabad" },
    { id: 14, name: "Surat" },
    { id: 15, name: "Vadodara" },
  ],
  6: [
    { id: 16, name: "Jaipur" },
    { id: 17, name: "Jodhpur" },
    { id: 18, name: "Udaipur" },
  ],
  7: [
    { id: 19, name: "Lucknow" },
    { id: 20, name: "Agra" },
    { id: 21, name: "Kanpur" },
  ],
  8: [
    { id: 22, name: "Kolkata" },
    { id: 23, name: "Howrah" },
    { id: 24, name: "Siliguri" },
  ],
  9: [
    { id: 25, name: "Hyderabad" },
    { id: 26, name: "Warangal" },
    { id: 27, name: "Karimnagar" },
  ],
  10: [
    { id: 28, name: "Patna" },
    { id: 29, name: "Gaya" },
    { id: 30, name: "Muzaffarpur" },
  ],
};

/* ─────────────────────────────────────────────────────────────
   VALIDATORS
───────────────────────────────────────────────────────────── */
const V = {
  title: (v) =>
    !v?.trim()
      ? "Title is required"
      : v.trim().length < 10
        ? "Min 10 characters"
        : v.trim().length > 120
          ? "Max 120 characters"
          : null,
  description: (v) =>
    !v?.trim()
      ? "Description is required"
      : v.trim().length < 20
        ? "Min 20 characters"
        : null,
  category: (v) => (!v ? "Please select a category" : null),
  state: (v) => (!v ? "Please select a state" : null),
  city: (v) => (!v ? "Please select a city" : null),
  area: (v) => (!v?.trim() ? "Area / locality is required" : null),
  pinCode: (v) =>
    v && !/^\d{6}$/.test(v.trim()) ? "Must be exactly 6 digits" : null,
  price: (v) =>
    !v
      ? "Price is required"
      : isNaN(+v) || +v <= 0
        ? "Enter a valid price"
        : null,
  name: (v) => (!v?.trim() ? "Full name is required" : null),
  phone: (v) =>
    !v?.trim()
      ? "Phone is required"
      : !/^\d{10}$/.test(v.replace(/\D/g, ""))
        ? "Enter valid 10-digit number"
        : null,
  email: (v) =>
    !v?.trim()
      ? "Email is required"
      : !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim())
        ? "Enter a valid email"
        : null,
  _num: (v, lbl) =>
    !v
      ? `${lbl} is required`
      : isNaN(+v) || +v < 0
        ? "Enter a valid number"
        : null,
  _sel: (v, lbl) => (!v ? `Please select ${lbl.toLowerCase()}` : null),
};

/* ─────────────────────────────────────────────────────────────
   SHARED DESIGN TOKENS
───────────────────────────────────────────────────────────── */
const FF = "'DM Sans', sans-serif";
const PRIMARY = "#00c89e";

function FieldErr({ msg }) {
  if (!msg) return null;
  return (
    <p
      style={{
        margin: "5px 0 0",
        fontSize: 11,
        color: "#ef4444",
        display: "flex",
        alignItems: "center",
        gap: 4,
        fontFamily: FF,
      }}
    >
      <span>⚠</span> {msg}
    </p>
  );
}

function Label({ children, optional }) {
  return (
    <label
      style={{
        display: "block",
        fontSize: 11,
        fontWeight: 700,
        textTransform: "uppercase",
        letterSpacing: "0.7px",
        color: "#374151",
        marginBottom: 7,
        fontFamily: FF,
      }}
    >
      {children}
      {optional && (
        <span
          style={{
            fontSize: 10,
            fontWeight: 400,
            color: "#9ca3af",
            textTransform: "none",
            marginLeft: 5,
          }}
        >
          (Optional)
        </span>
      )}
    </label>
  );
}

function iStyle(hasErr) {
  return {
    display: "block",
    width: "100%",
    height: 46,
    padding: "0 14px",
    border: `1.5px solid ${hasErr ? "#ef4444" : "#d1d5db"}`,
    borderRadius: 8,
    fontFamily: FF,
    fontSize: 13,
    fontWeight: 500,
    color: "#111827",
    background: "#fff",
    outline: "none",
    boxShadow: hasErr ? "0 0 0 3px rgba(239,68,68,.1)" : "none",
    transition: "border-color .15s, box-shadow .15s",
  };
}

/* ─────────────────────────────────────────────────────────────
   SEARCH DROPDOWN
   Defined OUTSIDE main component so it's never re-created.
───────────────────────────────────────────────────────────── */
function SelectDrop({ value, onChange, opts, placeholder, disabled }) {
  const [open, setOpen] = useState(false);
  const [q, setQ] = useState("");
  const ref = useRef(null);

  useEffect(() => {
    const h = (e) => {
      if (ref.current && !ref.current.contains(e.target)) setOpen(false);
    };
    document.addEventListener("mousedown", h);
    return () => document.removeEventListener("mousedown", h);
  }, []);

  const filtered = opts.filter((o) =>
    o.name.toLowerCase().includes(q.toLowerCase()),
  );

  return (
    <div ref={ref} style={{ position: "relative" }}>
      <div
        onClick={() => !disabled && setOpen((v) => !v)}
        style={{
          height: 46,
          display: "flex",
          alignItems: "center",
          justifyContent: "space-between",
          padding: "0 14px",
          background: disabled ? "#f9fafb" : "#fff",
          border: `1.5px solid ${open ? PRIMARY : "#d1d5db"}`,
          borderRadius: 8,
          cursor: disabled ? "not-allowed" : "pointer",
          opacity: disabled ? 0.5 : 1,
          boxShadow: open ? "0 0 0 3px rgba(0,200,158,.15)" : "none",
          transition: "border-color .15s, box-shadow .15s",
        }}
      >
        <span
          style={{
            fontSize: 13,
            color: value ? "#111827" : "#9ca3af",
            fontWeight: value ? 500 : 400,
            fontFamily: FF,
          }}
        >
          {value?.name || placeholder}
        </span>
        <span
          style={{
            fontSize: 10,
            color: "#9ca3af",
            display: "inline-block",
            transform: open ? "rotate(180deg)" : "none",
            transition: "transform .2s",
          }}
        >
          ▼
        </span>
      </div>

      {open && (
        <div
          style={{
            position: "absolute",
            top: "calc(100% + 6px)",
            left: 0,
            right: 0,
            zIndex: 600,
            background: "#fff",
            border: "1.5px solid #e5e7eb",
            borderRadius: 10,
            boxShadow: "0 12px 28px rgba(0,0,0,.12)",
            overflow: "hidden",
            maxHeight: 280,
            display: "flex",
            flexDirection: "column",
          }}
        >
          <div
            style={{ padding: "8px 10px", borderBottom: "1px solid #f3f4f6" }}
          >
            <input
              autoFocus
              value={q}
              onChange={(e) => setQ(e.target.value)}
              placeholder="Search..."
              style={{
                width: "100%",
                height: 34,
                padding: "0 10px",
                border: "1.5px solid #e5e7eb",
                borderRadius: 6,
                fontSize: 12,
                outline: "none",
                fontFamily: FF,
              }}
            />
          </div>
          <div style={{ overflowY: "auto" }}>
            {filtered.length === 0 ? (
              <div
                style={{
                  padding: 16,
                  textAlign: "center",
                  color: "#9ca3af",
                  fontSize: 13,
                }}
              >
                No results
              </div>
            ) : (
              filtered.map((o) => (
                <div
                  key={o.id}
                  onClick={() => {
                    onChange(o);
                    setOpen(false);
                    setQ("");
                  }}
                  style={{
                    padding: "10px 14px",
                    fontSize: 13,
                    cursor: "pointer",
                    fontFamily: FF,
                    background:
                      value?.id === o.id ? "rgba(0,200,158,.08)" : "#fff",
                    color: value?.id === o.id ? PRIMARY : "#111827",
                    fontWeight: value?.id === o.id ? 600 : 400,
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                    borderBottom: "1px solid #f9fafb",
                  }}
                >
                  {o.name}
                  {value?.id === o.id && (
                    <span
                      style={{ color: PRIMARY, fontWeight: 800, fontSize: 12 }}
                    >
                      ✓
                    </span>
                  )}
                </div>
              ))
            )}
          </div>
        </div>
      )}
    </div>
  );
}

/* ─────────────────────────────────────────────────────────────
   STEP COMPONENTS — all at module level (never re-created)
   Props-only: no closure over parent state → React keeps DOM
   nodes alive while user types, preserving focus.
───────────────────────────────────────────────────────────── */

function Step1({ form, upd, touch1, err }) {
  return (
    <div>
      {/* Sell / Rent */}
      <div style={{ marginBottom: 28 }}>
        <Label>I want to</Label>
        <div
          style={{
            display: "inline-flex",
            background: "#f3f4f6",
            border: "1.5px solid #e5e7eb",
            borderRadius: 10,
            padding: 4,
            gap: 4,
          }}
        >
          {["sell", "rent"].map((t) => (
            <button
              key={t}
              type="button"
              onClick={() => upd("listingType", t)}
              style={{
                padding: "10px 32px",
                border: "none",
                borderRadius: 8,
                cursor: "pointer",
                fontFamily: FF,
                fontSize: 13,
                fontWeight: 700,
                textTransform: "uppercase",
                letterSpacing: "0.5px",
                background: form.listingType === t ? PRIMARY : "transparent",
                color: form.listingType === t ? "#fff" : "#6b7280",
                boxShadow:
                  form.listingType === t
                    ? "0 2px 8px rgba(0,200,158,.35)"
                    : "none",
                transition: "all .2s",
              }}
            >
              {t === "sell" ? "🏷️ Sell" : "🔑 Rent"}
            </button>
          ))}
        </div>
      </div>

      {/* Category */}
      <div style={{ marginBottom: 28 }}>
        <Label>Property Category</Label>
        <p
          style={{
            fontSize: 12,
            color: "#6b7280",
            marginBottom: 12,
            fontFamily: FF,
          }}
        >
          Select the type of property you want to list
        </p>
        <div
          style={{
            display: "grid",
            gridTemplateColumns: "repeat(3,1fr)",
            gap: 12,
          }}
        >
          {CATEGORIES.map((c) => {
            const active = form.category?.id === c.id;
            return (
              <div
                key={c.id}
                onClick={() => upd("category", c)}
                style={{
                  display: "flex",
                  flexDirection: "column",
                  alignItems: "center",
                  gap: 8,
                  padding: "18px 12px",
                  borderRadius: 12,
                  cursor: "pointer",
                  border: `1.5px solid ${active ? PRIMARY : "#e5e7eb"}`,
                  background: active ? PRIMARY : "#fff",
                  boxShadow: active
                    ? "0 4px 16px rgba(0,200,158,.3)"
                    : "0 1px 3px rgba(0,0,0,.05)",
                  transform: active ? "translateY(-2px)" : "none",
                  transition: "all .15s",
                }}
              >
                <span style={{ fontSize: 28 }}>{c.icon}</span>
                <span
                  style={{
                    fontSize: 11,
                    fontWeight: 700,
                    textTransform: "uppercase",
                    letterSpacing: "0.4px",
                    color: active ? "#fff" : "#374151",
                    fontFamily: FF,
                  }}
                >
                  {c.name}
                </span>
              </div>
            );
          })}
        </div>
        <FieldErr msg={err("category")} />
      </div>

      {/* Title */}
      <div style={{ marginBottom: 28 }}>
        <Label>Property Title</Label>
        <input
          style={iStyle(!!err("title"))}
          placeholder="e.g., Beautiful 3BHK Apartment with Garden View"
          value={form.title}
          maxLength={120}
          onChange={(e) => upd("title", e.target.value)}
          onBlur={(e) => touch1("title", e.target.value)}
        />
        <div
          style={{
            display: "flex",
            justifyContent: "space-between",
            marginTop: 4,
          }}
        >
          <FieldErr msg={err("title")} />
          <span style={{ fontSize: 10, color: "#9ca3af", fontFamily: FF }}>
            {form.title.length}/120
          </span>
        </div>
      </div>

      {/* Description */}
      <div>
        <Label>Description</Label>
        <textarea
          style={{
            ...iStyle(!!err("description")),
            height: "auto",
            minHeight: 110,
            padding: "12px 14px",
            resize: "vertical",
            lineHeight: 1.6,
          }}
          placeholder="Describe the property in detail — condition, features, nearby facilities..."
          value={form.description}
          maxLength={1000}
          onChange={(e) => upd("description", e.target.value)}
          onBlur={(e) => touch1("description", e.target.value)}
        />
        <div
          style={{
            display: "flex",
            justifyContent: "space-between",
            marginTop: 4,
          }}
        >
          <FieldErr msg={err("description")} />
          <span style={{ fontSize: 10, color: "#9ca3af", fontFamily: FF }}>
            {form.description.length}/1000
          </span>
        </div>
      </div>
    </div>
  );
}

function Step2({ form, upd, touch1, err, cities }) {
  return (
    <div>
      <div
        style={{
          display: "grid",
          gridTemplateColumns: "1fr 1fr",
          gap: 16,
          marginBottom: 24,
        }}
      >
        <div>
          <Label>State</Label>
          <SelectDrop
            value={form.state}
            opts={STATES}
            placeholder="Select State"
            onChange={(v) => upd("state", v)}
          />
          <FieldErr msg={err("state")} />
        </div>
        <div>
          <Label>City</Label>
          <SelectDrop
            value={form.city}
            opts={cities}
            placeholder={form.state ? "Select City" : "Select state first"}
            disabled={!form.state}
            onChange={(v) => upd("city", v)}
          />
          <FieldErr msg={err("city")} />
        </div>
      </div>
      <div style={{ marginBottom: 24 }}>
        <Label>Area / Locality</Label>
        <input
          style={iStyle(!!err("area"))}
          placeholder="e.g., Koramangala, Banjara Hills, Andheri West"
          value={form.area}
          onChange={(e) => upd("area", e.target.value)}
          onBlur={(e) => touch1("area", e.target.value)}
        />
        <FieldErr msg={err("area")} />
      </div>
      <div style={{ maxWidth: 220 }}>
        <Label optional>Pin Code</Label>
        <input
          style={iStyle(!!err("pinCode"))}
          placeholder="e.g., 400001"
          maxLength={6}
          inputMode="numeric"
          value={form.pinCode}
          onChange={(e) =>
            upd("pinCode", e.target.value.replace(/\D/g, "").slice(0, 6))
          }
          onBlur={(e) => touch1("pinCode", e.target.value)}
        />
        <FieldErr msg={err("pinCode")} />
      </div>
    </div>
  );
}

function Step3({ form, upd, touch1, err, detFields }) {
  return (
    <div>
      <div style={{ marginBottom: 24, maxWidth: 300 }}>
        <Label>{`Price (${form.listingType === "rent" ? "Monthly Rent" : "Selling Price"})`}</Label>
        <div style={{ position: "relative" }}>
          <span
            style={{
              position: "absolute",
              left: 13,
              top: "50%",
              transform: "translateY(-50%)",
              fontSize: 16,
              fontWeight: 700,
              color: PRIMARY,
              pointerEvents: "none",
            }}
          >
            ₹
          </span>
          <input
            style={{ ...iStyle(!!err("price")), paddingLeft: 32 }}
            placeholder="Enter amount"
            inputMode="numeric"
            value={form.price}
            onChange={(e) => upd("price", e.target.value.replace(/\D/g, ""))}
            onBlur={(e) => touch1("price", e.target.value)}
          />
        </div>
        {form.price && !err("price") && (
          <p
            style={{
              margin: "4px 0 0",
              fontSize: 12,
              fontWeight: 600,
              color: PRIMARY,
              fontFamily: FF,
            }}
          >
            ₹{(+form.price).toLocaleString("en-IN")}
          </p>
        )}
        <FieldErr msg={err("price")} />
      </div>

      <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 20 }}>
        {detFields.map((f) =>
          f.type === "num" ? (
            <div key={f.key}>
              <Label>{f.label}</Label>
              <input
                style={iStyle(!!err(f.key))}
                placeholder={f.ph}
                type="number"
                min="0"
                value={form[f.key] || ""}
                onChange={(e) => upd(f.key, e.target.value)}
                onBlur={(e) => touch1(f.key, e.target.value)}
              />
              <FieldErr msg={err(f.key)} />
            </div>
          ) : (
            <div key={f.key} style={{ gridColumn: "1/-1" }}>
              <Label>{f.label}</Label>
              <div style={{ display: "flex", flexWrap: "wrap", gap: 8 }}>
                {f.opts.map((o) => (
                  <button
                    key={o}
                    type="button"
                    onClick={() => upd(f.key, o)}
                    style={{
                      padding: "8px 18px",
                      border: `1.5px solid ${form[f.key] === o ? PRIMARY : "#d1d5db"}`,
                      borderRadius: 8,
                      background: form[f.key] === o ? PRIMARY : "#fff",
                      color: form[f.key] === o ? "#fff" : "#374151",
                      fontFamily: FF,
                      fontSize: 12,
                      fontWeight: 700,
                      cursor: "pointer",
                      boxShadow:
                        form[f.key] === o
                          ? "0 2px 8px rgba(0,200,158,.3)"
                          : "none",
                      transition: "all .15s",
                    }}
                  >
                    {o}
                  </button>
                ))}
              </div>
              <FieldErr msg={err(f.key)} />
            </div>
          ),
        )}
      </div>
    </div>
  );
}

function Step4({ form, toggleAmenity, amenList }) {
  return (
    <div>
      <div
        style={{
          display: "grid",
          gridTemplateColumns: "repeat(3,1fr)",
          gap: 12,
          marginBottom: 16,
        }}
      >
        {amenList.map((a) => {
          const on = form.amenities.includes(a.n);
          return (
            <div
              key={a.id}
              onClick={() => toggleAmenity(a.n)}
              style={{
                display: "flex",
                alignItems: "center",
                gap: 10,
                padding: 14,
                border: `1.5px solid ${on ? PRIMARY : "#e5e7eb"}`,
                borderRadius: 10,
                cursor: "pointer",
                background: on ? "rgba(0,200,158,.06)" : "#fff",
                position: "relative",
                boxShadow: on
                  ? "0 2px 8px rgba(0,200,158,.15)"
                  : "0 1px 3px rgba(0,0,0,.04)",
                transform: on ? "translateY(-1px)" : "none",
                transition: "all .15s",
              }}
            >
              <span style={{ fontSize: 20 }}>{a.i}</span>
              <span
                style={{
                  fontSize: 11,
                  fontWeight: 700,
                  textTransform: "uppercase",
                  letterSpacing: "0.3px",
                  color: "#374151",
                  fontFamily: FF,
                }}
              >
                {a.n}
              </span>
              {on && (
                <span
                  style={{
                    position: "absolute",
                    top: 5,
                    right: 7,
                    width: 16,
                    height: 16,
                    background: PRIMARY,
                    borderRadius: "50%",
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    fontSize: 8,
                    color: "#fff",
                    fontWeight: 800,
                  }}
                >
                  ✓
                </span>
              )}
            </div>
          );
        })}
      </div>
      <div
        style={{
          textAlign: "center",
          padding: "10px 20px",
          background: "rgba(0,200,158,.08)",
          border: `1.5px solid ${PRIMARY}`,
          borderRadius: 8,
          fontSize: 12,
          fontWeight: 700,
          color: "#00a07f",
          fontFamily: FF,
          letterSpacing: "0.4px",
        }}
      >
        {form.amenities.length === 0
          ? "No amenities selected"
          : `${form.amenities.length} Amenit${form.amenities.length === 1 ? "y" : "ies"} Selected`}
      </div>
    </div>
  );
}

function Step5({
  form,
  upd,
  imgRef,
  vidRef,
  handleImages,
  removeImg,
  handleVideo,
}) {
  return (
    <div>
      <div style={{ marginBottom: 28 }}>
        <Label>{`Property Images${form.images.length > 0 ? ` (${form.images.length}/10)` : ""}`}</Label>
        <p
          style={{
            fontSize: 12,
            color: "#6b7280",
            marginBottom: 14,
            fontFamily: FF,
          }}
        >
          Minimum 3 required · First image is the cover photo
        </p>
        <div style={{ display: "flex", flexWrap: "wrap", gap: 12 }}>
          {form.images.map((img, i) => (
            <div
              key={i}
              style={{
                position: "relative",
                width: 110,
                height: 110,
                borderRadius: 10,
                overflow: "hidden",
                boxShadow: "0 2px 8px rgba(0,0,0,.1)",
                flexShrink: 0,
              }}
            >
              <img
                src={img.url}
                alt=""
                style={{
                  width: "100%",
                  height: "100%",
                  objectFit: "cover",
                  display: "block",
                }}
              />
              <div
                onClick={() => removeImg(i)}
                style={{
                  position: "absolute",
                  top: -5,
                  right: -5,
                  width: 22,
                  height: 22,
                  background: "#ef4444",
                  border: "2.5px solid #fff",
                  borderRadius: "50%",
                  display: "flex",
                  alignItems: "center",
                  justifyContent: "center",
                  cursor: "pointer",
                  fontSize: 10,
                  color: "#fff",
                  fontWeight: 800,
                  zIndex: 1,
                }}
              >
                ✕
              </div>
            </div>
          ))}
          {form.images.length < 10 && (
            <div
              onClick={() => imgRef.current?.click()}
              style={{
                width: 110,
                height: 110,
                border: `2px dashed ${PRIMARY}`,
                borderRadius: 10,
                background: "rgba(0,200,158,.04)",
                display: "flex",
                flexDirection: "column",
                alignItems: "center",
                justifyContent: "center",
                gap: 4,
                cursor: "pointer",
                flexShrink: 0,
              }}
            >
              <span style={{ fontSize: 26, color: PRIMARY }}>+</span>
              <span
                style={{
                  fontSize: 10,
                  fontWeight: 700,
                  color: PRIMARY,
                  textTransform: "uppercase",
                  letterSpacing: "0.4px",
                  fontFamily: FF,
                }}
              >
                Add Photo
              </span>
            </div>
          )}
        </div>
        <input
          ref={imgRef}
          type="file"
          accept="image/*"
          multiple
          style={{ display: "none" }}
          onChange={handleImages}
        />
        {form.images.length < 3 && (
          <div
            style={{
              marginTop: 12,
              padding: "10px 14px",
              background: "#fffbeb",
              border: "1.5px solid #fcd34d",
              borderLeft: "4px solid #f59e0b",
              borderRadius: 8,
              fontSize: 12,
              color: "#92400e",
              fontFamily: FF,
            }}
          >
            ⚠️ Add {3 - form.images.length} more image
            {3 - form.images.length > 1 ? "s" : ""} to continue
          </div>
        )}
      </div>
      <div>
        <Label optional>Property Video</Label>
        <p
          style={{
            fontSize: 12,
            color: "#6b7280",
            marginBottom: 12,
            fontFamily: FF,
          }}
        >
          Short walkthrough video — up to 100MB
        </p>
        {form.video ? (
          <div
            style={{
              border: "1.5px solid #e5e7eb",
              borderRadius: 10,
              overflow: "hidden",
            }}
          >
            <video
              src={form.video.url}
              controls
              style={{
                display: "block",
                width: "100%",
                height: 200,
                objectFit: "cover",
                background: "#111",
              }}
            />
            <div
              style={{
                display: "flex",
                gap: 8,
                padding: "10px 12px",
                background: "#f9fafb",
              }}
            >
              <button
                type="button"
                onClick={() => vidRef.current?.click()}
                style={{
                  flex: 1,
                  padding: "8px 0",
                  background: PRIMARY,
                  color: "#fff",
                  border: "none",
                  borderRadius: 6,
                  fontSize: 11,
                  fontWeight: 700,
                  cursor: "pointer",
                  fontFamily: FF,
                }}
              >
                🔄 Change
              </button>
              <button
                type="button"
                onClick={() => upd("video", null)}
                style={{
                  flex: 1,
                  padding: "8px 0",
                  background: "#fef2f2",
                  color: "#ef4444",
                  border: "none",
                  borderRadius: 6,
                  fontSize: 11,
                  fontWeight: 700,
                  cursor: "pointer",
                  fontFamily: FF,
                }}
              >
                🗑️ Remove
              </button>
            </div>
          </div>
        ) : (
          <button
            type="button"
            onClick={() => vidRef.current?.click()}
            style={{
              width: "100%",
              padding: 24,
              background: "#f9fafb",
              border: "2px dashed #d1d5db",
              borderRadius: 10,
              fontSize: 12,
              fontWeight: 700,
              color: "#6b7280",
              cursor: "pointer",
              fontFamily: FF,
              textTransform: "uppercase",
              letterSpacing: "0.5px",
            }}
          >
            🎥 Upload Video Tour
          </button>
        )}
        <input
          ref={vidRef}
          type="file"
          accept="video/*"
          style={{ display: "none" }}
          onChange={handleVideo}
        />
      </div>
    </div>
  );
}

function Step6({ form, upd, touch1, err }) {
  return (
    <div>
      <div style={{ marginBottom: 24 }}>
        <Label>Full Name</Label>
        <input
          style={iStyle(!!err("name"))}
          placeholder="Your full name"
          value={form.name}
          onChange={(e) => upd("name", e.target.value)}
          onBlur={(e) => touch1("name", e.target.value)}
        />
        <FieldErr msg={err("name")} />
      </div>
      <div
        style={{
          display: "grid",
          gridTemplateColumns: "1fr 1fr",
          gap: 16,
          marginBottom: 24,
        }}
      >
        <div>
          <Label>Phone Number</Label>
          <input
            style={iStyle(!!err("phone"))}
            placeholder="e.g., 98765 43210"
            type="tel"
            maxLength={15}
            value={form.phone}
            onChange={(e) =>
              upd("phone", e.target.value.replace(/[^\d\s+\-()]/g, ""))
            }
            onBlur={(e) => touch1("phone", e.target.value)}
          />
          <FieldErr msg={err("phone")} />
        </div>
        <div>
          <Label>Email Address</Label>
          <input
            style={iStyle(!!err("email"))}
            placeholder="you@example.com"
            type="email"
            value={form.email}
            onChange={(e) => upd("email", e.target.value.trim())}
            onBlur={(e) => touch1("email", e.target.value)}
          />
          <FieldErr msg={err("email")} />
        </div>
      </div>
      <div
        style={{
          display: "flex",
          alignItems: "flex-start",
          gap: 12,
          padding: 16,
          background: "#eff6ff",
          border: "1.5px solid #bfdbfe",
          borderLeft: "4px solid #3b82f6",
          borderRadius: 8,
          fontSize: 12,
          color: "#1e3a5f",
          fontFamily: FF,
          lineHeight: 1.6,
        }}
      >
        <span style={{ fontSize: 18, flexShrink: 0 }}>🔒</span>
        <span>
          Your contact details are shared only with verified buyers or renters
          who express interest in your property.
        </span>
      </div>
    </div>
  );
}

function Step7({ form, detFields, setStep, submit, submitting, success }) {
  const parts = [];
  detFields.forEach((f) => {
    const v = form[f.key];
    if (!v) return;
    if (f.key === "areaSqft") parts.push(`${v} sq ft`);
    else if (f.key === "floor" && form.totalFloors)
      parts.push(`Floor ${v}/${form.totalFloors}`);
    else if (f.key === "totalFloors") {
    } else if (f.key === "bhk") parts.push(v);
    else if (f.key === "bathrooms") parts.push(`${v} Bath`);
    else if (f.key === "furnishing") parts.push(v);
    else parts.push(`${f.label}: ${v}`);
  });

  const rows = [
    {
      lbl: "📍 Location",
      val:
        [form.area, form.city?.name, form.state?.name]
          .filter(Boolean)
          .join(", ") + (form.pinCode ? ` — ${form.pinCode}` : ""),
    },
    parts.length > 0 && { lbl: "🏠 Details", val: parts.join(" · ") },
    form.amenities.length > 0 && {
      lbl: "✨ Amenities",
      val: form.amenities.join(", "),
    },
    {
      lbl: "📷 Photos",
      val: `${form.images.length} image${form.images.length !== 1 ? "s" : ""}${form.video ? " + 1 video" : ""}`,
    },
    { lbl: "👤 Contact", val: form.name || "—" },
    { lbl: "📞 Phone", val: form.phone || "—" },
    { lbl: "📧 Email", val: form.email || "—" },
  ].filter(Boolean);

  return (
    <div>
      {success && (
        <div
          style={{
            marginBottom: 20,
            padding: "14px 18px",
            background: "#f0fdf9",
            border: "1.5px solid #6ee7b7",
            borderLeft: `4px solid ${PRIMARY}`,
            borderRadius: 8,
            fontSize: 14,
            fontWeight: 700,
            color: "#065f46",
            fontFamily: FF,
          }}
        >
          🎉 Property posted successfully!
        </div>
      )}
      <div
        style={{
          background: "#fff",
          border: "1.5px solid #e5e7eb",
          borderRadius: 14,
          padding: 28,
          boxShadow: "0 4px 16px rgba(0,0,0,.06)",
          marginBottom: 20,
        }}
      >
        <div
          style={{
            display: "flex",
            justifyContent: "space-between",
            alignItems: "flex-start",
            marginBottom: 16,
          }}
        >
          <span
            style={{
              display: "inline-flex",
              alignItems: "center",
              gap: 6,
              padding: "5px 14px",
              background: "rgba(0,200,158,.1)",
              color: "#00a07f",
              borderRadius: 999,
              fontSize: 11,
              fontWeight: 800,
              textTransform: "uppercase",
              letterSpacing: "0.6px",
              fontFamily: FF,
            }}
          >
            {form.listingType === "sell" ? "🏷️ For Sale" : "🔑 For Rent"}
          </span>
          <span
            style={{
              fontSize: 26,
              fontWeight: 800,
              color: PRIMARY,
              fontFamily: FF,
            }}
          >
            {form.price
              ? `₹${(+form.price).toLocaleString("en-IN")}`
              : "Price on Request"}
          </span>
        </div>
        <div
          style={{
            fontSize: 18,
            fontWeight: 800,
            color: "#111827",
            textTransform: "uppercase",
            letterSpacing: "0.3px",
            marginBottom: 6,
            fontFamily: FF,
          }}
        >
          {form.title || "Untitled Property"}
        </div>
        <div
          style={{
            display: "inline-flex",
            alignItems: "center",
            gap: 6,
            fontSize: 12,
            fontWeight: 600,
            color: "#6b7280",
            marginBottom: 20,
            fontFamily: FF,
          }}
        >
          <span>{form.category?.icon || "🏠"}</span>
          <span>{form.category?.name || "Property"}</span>
        </div>
        <hr
          style={{
            border: "none",
            borderTop: "1px solid #f3f4f6",
            margin: "0 0 16px",
          }}
        />
        {rows.map((row, i) => (
          <div
            key={i}
            style={{
              display: "flex",
              alignItems: "flex-start",
              gap: 16,
              padding: "9px 0",
              borderBottom: "1px solid #f9fafb",
            }}
          >
            <span
              style={{
                width: 130,
                flexShrink: 0,
                fontSize: 11,
                fontWeight: 700,
                textTransform: "uppercase",
                letterSpacing: "0.4px",
                color: "#9ca3af",
                fontFamily: FF,
                paddingTop: 1,
              }}
            >
              {row.lbl}
            </span>
            <span
              style={{
                fontSize: 13,
                fontWeight: 500,
                color: "#111827",
                fontFamily: FF,
                flex: 1,
                lineHeight: 1.5,
              }}
            >
              {row.val}
            </span>
          </div>
        ))}
        {form.images.length > 0 && (
          <div
            style={{ display: "flex", flexWrap: "wrap", gap: 8, marginTop: 12 }}
          >
            {form.images.slice(0, 6).map((img, i) => (
              <img
                key={i}
                src={img.url}
                alt=""
                style={{
                  width: 76,
                  height: 56,
                  objectFit: "cover",
                  borderRadius: 6,
                  border: "1.5px solid #e5e7eb",
                }}
              />
            ))}
            {form.images.length > 6 && (
              <div
                style={{
                  width: 76,
                  height: 56,
                  background: "#f3f4f6",
                  borderRadius: 6,
                  display: "flex",
                  alignItems: "center",
                  justifyContent: "center",
                  fontSize: 13,
                  fontWeight: 700,
                  color: "#6b7280",
                  fontFamily: FF,
                }}
              >
                +{form.images.length - 6}
              </div>
            )}
          </div>
        )}
      </div>
      <button
        type="button"
        onClick={() => setStep(1)}
        style={{
          width: "100%",
          padding: "13px 0",
          marginBottom: 10,
          background: "#fff",
          border: `1.5px solid ${PRIMARY}`,
          color: PRIMARY,
          borderRadius: 8,
          fontSize: 12,
          fontWeight: 800,
          fontFamily: FF,
          textTransform: "uppercase",
          letterSpacing: "0.7px",
          cursor: "pointer",
        }}
      >
        ✏️ Edit Details
      </button>
      <button
        type="button"
        onClick={submit}
        disabled={submitting || success}
        style={{
          width: "100%",
          padding: "15px 0",
          border: "none",
          borderRadius: 8,
          fontSize: 13,
          fontWeight: 800,
          fontFamily: FF,
          textTransform: "uppercase",
          letterSpacing: "0.7px",
          cursor: success || submitting ? "not-allowed" : "pointer",
          background: success ? "#d1fae5" : PRIMARY,
          color: success ? "#065f46" : "#fff",
          boxShadow: success ? "none" : "0 4px 16px rgba(0,200,158,.35)",
          transition: "all .2s",
        }}
      >
        {submitting
          ? "Submitting…"
          : success
            ? "✅ Submitted!"
            : "✅ Submit Property"}
      </button>
    </div>
  );
}

/* ─────────────────────────────────────────────────────────────
   MAIN COMPONENT
───────────────────────────────────────────────────────────── */
export default function PostProperty() {
  const [step, setStep] = useState(1);
  const [touched, setTouch] = useState({});
  const [errs, setErrs] = useState({});
  const [cities, setCities] = useState([]);
  const [submitting, setSub] = useState(false);
  const [success, setSuccess] = useState(false);

  const imgRef = useRef(null);
  const vidRef = useRef(null);
  const topRef = useRef(null);

  const [form, setForm] = useState({
    listingType: "sell",
    category: null,
    title: "",
    description: "",
    state: null,
    city: null,
    area: "",
    pinCode: "",
    price: "",
    areaSqft: "",
    bhk: "",
    bathrooms: "",
    floor: "",
    totalFloors: "",
    furnishing: "",
    plotLength: "",
    plotBreadth: "",
    boundaryWall: "",
    facing: "",
    approval: "",
    washrooms: "",
    cabins: "",
    plotArea: "",
    amenities: [],
    images: [],
    video: null,
    name: "",
    phone: "",
    email: "",
  });

  const catName = form.category?.name;
  const detFields = DETAILS_MAP[catName] || DETAILS_MAP.default;
  const amenList = AMENITIES_MAP[catName] || AMENITIES_MAP.default;

  useEffect(() => {
    if (form.state) {
      setCities(CITIES[form.state.id] || []);
      setForm((p) => ({ ...p, city: null }));
    } else {
      setCities([]);
    }
  }, [form.state]);

  /* Stable callbacks — won't cause child re-renders */
  const upd = useCallback((k, v) => {
    setForm((p) => ({ ...p, [k]: v }));
    setTouch((p) => ({ ...p, [k]: true }));
    const fn = V[k];
    if (fn) setErrs((p) => ({ ...p, [k]: fn(v) }));
  }, []);

  const touch1 = useCallback((k, v) => {
    setTouch((p) => ({ ...p, [k]: true }));
    const fn = V[k];
    if (fn) setErrs((p) => ({ ...p, [k]: fn(v) }));
  }, []);

  const err = useCallback(
    (k) => (touched[k] ? errs[k] : null),
    [touched, errs],
  );

  const toggleAmenity = useCallback((n) => {
    setForm((p) => ({
      ...p,
      amenities: p.amenities.includes(n)
        ? p.amenities.filter((a) => a !== n)
        : [...p.amenities, n],
    }));
  }, []);

  const handleImages = useCallback((e) => {
    const files = Array.from(e.target.files || []);
    const imgs = files.map((f) => ({ file: f, url: URL.createObjectURL(f) }));
    setForm((p) => ({ ...p, images: [...p.images, ...imgs].slice(0, 10) }));
    e.target.value = "";
  }, []);

  const removeImg = useCallback((i) => {
    setForm((p) => ({ ...p, images: p.images.filter((_, idx) => idx !== i) }));
  }, []);

  const handleVideo = useCallback((e) => {
    const f = e.target.files?.[0];
    if (f)
      setForm((p) => ({
        ...p,
        video: { file: f, url: URL.createObjectURL(f) },
      }));
    e.target.value = "";
  }, []);

  function validateStep(s) {
    const e = {};
    if (s === 1) {
      e.category = V.category(form.category);
      e.title = V.title(form.title);
      e.description = V.description(form.description);
    }
    if (s === 2) {
      e.state = V.state(form.state);
      e.city = V.city(form.city);
      e.area = V.area(form.area);
      e.pinCode = V.pinCode(form.pinCode);
    }
    if (s === 3) {
      e.price = V.price(form.price);
      detFields.forEach((f) => {
        e[f.key] =
          f.type === "sel"
            ? V._sel(form[f.key], f.label)
            : V._num(form[f.key], f.label);
      });
    }
    if (s === 6) {
      e.name = V.name(form.name);
      e.phone = V.phone(form.phone);
      e.email = V.email(form.email);
    }
    Object.keys(e).forEach((k) => {
      if (!e[k]) delete e[k];
    });
    return e;
  }

  function canGo() {
    const e = validateStep(step);
    if (Object.keys(e).length > 0) return false;
    if (step === 5 && form.images.length < 3) return false;
    return true;
  }

  function next() {
    const e = validateStep(step);
    const t = {};
    Object.keys(e).forEach((k) => (t[k] = true));
    setTouch((p) => ({ ...p, ...t }));
    setErrs((p) => ({ ...p, ...e }));
    if (Object.keys(e).length > 0) return;
    if (step === 5 && form.images.length < 3) return;
    setStep((s) => s + 1);
    topRef.current?.scrollIntoView({ behavior: "smooth" });
  }

  function prev() {
    setStep((s) => s - 1);
    topRef.current?.scrollIntoView({ behavior: "smooth" });
  }

  async function submit() {
    setSub(true);
    await new Promise((r) => setTimeout(r, 1800));
    setSub(false);
    setSuccess(true);
  }

  const stepTitles = [
    "Basic Information",
    "Location",
    "Property Details",
    "Amenities",
    "Media Upload",
    "Contact Details",
    "Preview & Submit",
  ];
  const stepSubs = [
    "Tell us what kind of property you want to post",
    "Where is your property located?",
    "Specific details, size and specifications",
    "Select available amenities and facilities",
    "Upload photos and a video walkthrough",
    "Your contact info for interested parties",
    "Review everything before posting",
  ];

  const shared = { form, upd, touch1, err };

  return (
    <>
      <style>{`
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900&family=Syne:wght@700;800&display=swap');
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f4f5f7; }
        input:focus, textarea:focus {
          border-color: #00c89e !important;
          box-shadow: 0 0 0 3px rgba(0,200,158,.15) !important;
          outline: none !important;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 999px; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .step-anim { animation: fadeUp .2s ease-out; }
      `}</style>

      <div
        style={{ minHeight: "100vh", background: "#f1f3f5", fontFamily: FF }}
      >
        {/* HEADER */}
        <header
          ref={topRef}
          style={{
            background: "#0d2e2b",
            height: 66,
            display: "flex",
            alignItems: "center",
            justifyContent: "space-between",
            padding: "0 40px",
            position: "sticky",
            top: 0,
            zIndex: 200,
            boxShadow: "0 2px 16px rgba(0,0,0,.3)",
          }}
        >
          <div style={{ display: "flex", alignItems: "center", gap: 12 }}>
            <div
              style={{
                width: 36,
                height: 36,
                background: PRIMARY,
                borderRadius: 6,
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                fontSize: 18,
                flexShrink: 0,
              }}
            >
              🏠
            </div>
            <div>
              <div
                style={{
                  fontFamily: "'Syne',sans-serif",
                  fontSize: 14,
                  fontWeight: 800,
                  color: "#fff",
                  letterSpacing: "1.5px",
                  textTransform: "uppercase",
                  lineHeight: 1,
                }}
              >
                Post Property
              </div>
              <div
                style={{
                  fontSize: 11,
                  color: "rgba(255,255,255,.45)",
                  marginTop: 3,
                }}
              >
                List your property in minutes
              </div>
            </div>
          </div>
          <button
            type="button"
            style={{
              padding: "8px 18px",
              background: "rgba(255,255,255,.08)",
              border: "1px solid rgba(255,255,255,.15)",
              color: "#fff",
              borderRadius: 6,
              fontSize: 11,
              fontWeight: 700,
              cursor: "pointer",
              letterSpacing: "0.7px",
              fontFamily: FF,
              textTransform: "uppercase",
            }}
          >
            ← Back to Listings
          </button>
        </header>

        {/* STEP BAR */}
        <div
          style={{
            background: "#fff",
            borderBottom: "1px solid #e5e7eb",
            position: "sticky",
            top: 66,
            zIndex: 150,
            boxShadow: "0 1px 4px rgba(0,0,0,.06)",
          }}
        >
          <div
            style={{
              maxWidth: 1100,
              margin: "0 auto",
              padding: "0 40px",
              display: "flex",
              alignItems: "center",
              height: 64,
            }}
          >
            {STEPS.map((s, i) => {
              const done = step > s.id,
                active = step === s.id;
              return (
                <div
                  key={s.id}
                  style={{
                    display: "flex",
                    alignItems: "center",
                    flex: i < STEPS.length - 1 ? 1 : "0 0 auto",
                  }}
                >
                  <div
                    onClick={() => done && setStep(s.id)}
                    style={{
                      display: "flex",
                      alignItems: "center",
                      gap: 8,
                      cursor: done ? "pointer" : "default",
                      flexShrink: 0,
                      opacity: !active && !done ? 0.35 : 1,
                      transition: "opacity .2s",
                    }}
                  >
                    <div
                      style={{
                        width: 32,
                        height: 32,
                        borderRadius: "50%",
                        display: "flex",
                        alignItems: "center",
                        justifyContent: "center",
                        fontSize: done ? 13 : 14,
                        fontWeight: done ? 800 : 500,
                        background: active || done ? PRIMARY : "#fff",
                        border: `2px solid ${active || done ? PRIMARY : "#d1d5db"}`,
                        color: active || done ? "#fff" : "#9ca3af",
                        flexShrink: 0,
                        boxShadow: active
                          ? "0 0 0 4px rgba(0,200,158,.2)"
                          : "none",
                        transition: "all .2s",
                      }}
                    >
                      {done ? "✓" : s.icon}
                    </div>
                    <span
                      style={{
                        fontSize: 10.5,
                        fontWeight: 700,
                        textTransform: "uppercase",
                        letterSpacing: "0.6px",
                        color: active ? PRIMARY : done ? "#111827" : "#9ca3af",
                        whiteSpace: "nowrap",
                        fontFamily: FF,
                        transition: "color .2s",
                      }}
                    >
                      {s.label}
                    </span>
                  </div>
                  {i < STEPS.length - 1 && (
                    <div
                      style={{
                        flex: 1,
                        height: 2,
                        background: done ? PRIMARY : "#e5e7eb",
                        margin: "0 10px",
                        borderRadius: 999,
                        transition: "background .3s",
                      }}
                    />
                  )}
                </div>
              );
            })}
          </div>
          <div style={{ height: 3, background: "#f3f4f6" }}>
            <div
              style={{
                height: "100%",
                background: `linear-gradient(90deg,${PRIMARY},#00e0b0)`,
                width: `${((step - 1) / 6) * 100}%`,
                transition: "width .35s cubic-bezier(.16,1,.3,1)",
                borderRadius: "0 999px 999px 0",
              }}
            />
          </div>
        </div>

        {/* PAGE BODY */}
        <div
          style={{
            maxWidth: 1100,
            margin: "0 auto",
            padding: "36px 40px 80px",
            display: "grid",
            gridTemplateColumns: "1fr 340px",
            gap: 32,
            alignItems: "start",
          }}
        >
          {/* Left */}
          <div>
            <div style={{ marginBottom: 24 }}>
              <span
                style={{
                  display: "inline-block",
                  padding: "4px 12px",
                  background: "rgba(0,200,158,.1)",
                  color: "#00a07f",
                  borderRadius: 999,
                  fontSize: 10,
                  fontWeight: 800,
                  textTransform: "uppercase",
                  letterSpacing: "1.8px",
                  fontFamily: FF,
                  marginBottom: 10,
                }}
              >
                Step {step} of 7
              </span>
              <h1
                style={{
                  fontFamily: "'Syne',sans-serif",
                  fontSize: 22,
                  fontWeight: 800,
                  color: "#111827",
                  textTransform: "uppercase",
                  letterSpacing: "0.4px",
                  paddingLeft: 16,
                  position: "relative",
                  marginBottom: 5,
                  lineHeight: 1.2,
                }}
              >
                <span
                  style={{
                    position: "absolute",
                    left: 0,
                    top: 0,
                    bottom: 0,
                    width: 4,
                    background: PRIMARY,
                    borderRadius: 999,
                  }}
                />
                {stepTitles[step - 1]}
              </h1>
              <p style={{ fontSize: 13, color: "#6b7280", fontFamily: FF }}>
                {stepSubs[step - 1]}
              </p>
            </div>

            <div
              style={{
                background: "#fff",
                borderRadius: 14,
                padding: 32,
                boxShadow: "0 2px 12px rgba(0,0,0,.06)",
                border: "1px solid #e5e7eb",
              }}
            >
              {/* className animates on step change; key does NOT go on the step component */}
              <div className="step-anim" key={step}>
                {step === 1 && <Step1 {...shared} />}
                {step === 2 && <Step2 {...shared} cities={cities} />}
                {step === 3 && <Step3 {...shared} detFields={detFields} />}
                {step === 4 && (
                  <Step4
                    form={form}
                    toggleAmenity={toggleAmenity}
                    amenList={amenList}
                  />
                )}
                {step === 5 && (
                  <Step5
                    form={form}
                    upd={upd}
                    imgRef={imgRef}
                    vidRef={vidRef}
                    handleImages={handleImages}
                    removeImg={removeImg}
                    handleVideo={handleVideo}
                  />
                )}
                {step === 6 && <Step6 {...shared} />}
                {step === 7 && (
                  <Step7
                    form={form}
                    detFields={detFields}
                    setStep={setStep}
                    submit={submit}
                    submitting={submitting}
                    success={success}
                  />
                )}
              </div>
            </div>

            {step < 7 && (
              <div style={{ display: "flex", gap: 12, marginTop: 16 }}>
                {step > 1 && (
                  <button
                    type="button"
                    onClick={prev}
                    style={{
                      padding: "13px 28px",
                      background: "#fff",
                      border: "1.5px solid #d1d5db",
                      color: "#6b7280",
                      borderRadius: 8,
                      fontSize: 12,
                      fontWeight: 800,
                      textTransform: "uppercase",
                      letterSpacing: "0.7px",
                      cursor: "pointer",
                      fontFamily: FF,
                    }}
                  >
                    ← Previous
                  </button>
                )}
                <button
                  type="button"
                  onClick={next}
                  disabled={!canGo()}
                  style={{
                    flex: 1,
                    padding: "13px 0",
                    borderRadius: 8,
                    border: "none",
                    fontSize: 12,
                    fontWeight: 800,
                    textTransform: "uppercase",
                    letterSpacing: "0.7px",
                    fontFamily: FF,
                    cursor: canGo() ? "pointer" : "not-allowed",
                    transition: "all .2s",
                    background: canGo() ? PRIMARY : "#d1d5db",
                    color: canGo() ? "#fff" : "#9ca3af",
                    boxShadow: canGo()
                      ? "0 4px 14px rgba(0,200,158,.35)"
                      : "none",
                  }}
                >
                  Continue →
                </button>
              </div>
            )}
          </div>

          {/* Right sidebar */}
          <div style={{ position: "sticky", top: 148 }}>
            <div
              style={{
                background: "#fff",
                borderRadius: 14,
                padding: 24,
                boxShadow: "0 2px 12px rgba(0,0,0,.06)",
                border: "1px solid #e5e7eb",
                marginBottom: 16,
              }}
            >
              <div
                style={{
                  fontSize: 11,
                  fontWeight: 800,
                  textTransform: "uppercase",
                  letterSpacing: "1px",
                  color: "#9ca3af",
                  marginBottom: 14,
                  fontFamily: FF,
                }}
              >
                Your Progress
              </div>
              {STEPS.map((s) => {
                const done = step > s.id,
                  active = step === s.id;
                return (
                  <div
                    key={s.id}
                    style={{
                      display: "flex",
                      alignItems: "center",
                      gap: 10,
                      padding: "7px 0",
                      opacity: !done && !active ? 0.35 : 1,
                    }}
                  >
                    <div
                      style={{
                        width: 22,
                        height: 22,
                        borderRadius: "50%",
                        background: done
                          ? PRIMARY
                          : active
                            ? "rgba(0,200,158,.15)"
                            : "#f3f4f6",
                        border: `2px solid ${active ? PRIMARY : done ? PRIMARY : "#e5e7eb"}`,
                        display: "flex",
                        alignItems: "center",
                        justifyContent: "center",
                        fontSize: 9,
                        color: done ? "#fff" : active ? PRIMARY : "#9ca3af",
                        fontWeight: 800,
                        flexShrink: 0,
                      }}
                    >
                      {done ? "✓" : s.id}
                    </div>
                    <span
                      style={{
                        fontSize: 12,
                        fontWeight: active ? 700 : 500,
                        color: active ? PRIMARY : done ? "#374151" : "#9ca3af",
                        fontFamily: FF,
                      }}
                    >
                      {s.label}
                    </span>
                    {active && (
                      <span
                        style={{
                          marginLeft: "auto",
                          fontSize: 9,
                          fontWeight: 800,
                          color: PRIMARY,
                          textTransform: "uppercase",
                          letterSpacing: "0.5px",
                          fontFamily: FF,
                        }}
                      >
                        Current
                      </span>
                    )}
                  </div>
                );
              })}
            </div>
            <div
              style={{
                background: "linear-gradient(135deg,#0d2e2b,#1a4a44)",
                borderRadius: 14,
                padding: 24,
              }}
            >
              <div
                style={{
                  fontSize: 11.5,
                  fontWeight: 800,
                  fontFamily: "'Syne',sans-serif",
                  marginBottom: 6,
                  color: "#fff",
                  letterSpacing: "0.3px",
                  lineHeight: 1.05,
                }}
              >
                💡 Quick Tips
              </div>
              {[
                "Add 5+ high-quality photos for 3× more leads",
                "Include nearby landmarks in your description",
                "Accurate pricing gets 2× faster responses",
                "Video tours increase inquiries by 40%",
              ].map((tip, i) => (
                <div
                  key={i}
                  style={{
                    display: "flex",
                    gap: 8,
                    marginBottom: 10,
                    fontSize: 11,
                    color: "rgba(255,255,255,.75)",
                    lineHeight: 1.5,
                    fontFamily: FF,
                  }}
                >
                  <span
                    style={{ color: PRIMARY, fontWeight: 800, flexShrink: 0 }}
                  >
                    →
                  </span>
                  {tip}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
