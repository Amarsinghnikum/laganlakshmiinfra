const API_ENDPOINTS = {
  login: "/api/login/",
  loginGoogle: "/api/login/google",
  loginApple: "/api/login/apple",
  register: "/api/register",
  forgotPassword: "/api/forgot-password",
  resetPassword: "/api/reset-password",
};

const AUTH_STORAGE_KEY = "laganlakshmi_auth_session";

function isObject(value) {
  return typeof value === "object" && value !== null;
}

function parseResponseBody(text) {
  if (!text) {
    return null;
  }

  try {
    return JSON.parse(text);
  } catch {
    return text;
  }
}

function extractMessage(payload, fallbackMessage) {
  if (typeof payload === "string" && payload.trim()) {
    return payload;
  }

  if (!isObject(payload)) {
    return fallbackMessage;
  }

  const candidates = [
    payload.message,
    payload.error,
    payload.detail,
    payload.status,
  ];

  for (const candidate of candidates) {
    if (typeof candidate === "string" && candidate.trim()) {
      return candidate;
    }
  }

  if (Array.isArray(payload.errors) && payload.errors.length > 0) {
    const firstError = payload.errors[0];
    if (typeof firstError === "string" && firstError.trim()) {
      return firstError;
    }
  }

  if (isObject(payload.errors)) {
    const firstEntry = Object.values(payload.errors).find(Boolean);
    if (Array.isArray(firstEntry) && typeof firstEntry[0] === "string") {
      return firstEntry[0];
    }

    if (typeof firstEntry === "string") {
      return firstEntry;
    }
  }

  return fallbackMessage;
}

function extractToken(payload) {
  if (!isObject(payload)) {
    return "";
  }

  const directToken = [
    payload.token,
    payload.access_token,
    payload.accessToken,
    payload.auth_token,
    payload.jwt,
  ].find((value) => typeof value === "string" && value.trim());

  if (directToken) {
    return directToken;
  }

  const nestedSources = [payload.data, payload.user, payload.result].filter(
    isObject,
  );

  for (const source of nestedSources) {
    const nestedToken = extractToken(source);
    if (nestedToken) {
      return nestedToken;
    }
  }

  return "";
}

function extractUser(payload) {
  if (!isObject(payload)) {
    return null;
  }

  const directUser = [payload.user, payload.data?.user, payload.data, payload.result]
    .filter(isObject)
    .find((candidate) =>
      ["name", "email", "phone", "mobile", "id"].some((key) => key in candidate),
    );

  return directUser || null;
}

function createAuthHeaders(token) {
  const headers = {
    Accept: "application/json",
    "Content-Type": "application/json",
  };

  if (token) {
    headers.Authorization = `Bearer ${token}`;
  }

  return headers;
}

async function request(url, options = {}) {
  const response = await fetch(url, {
    ...options,
    headers: {
      ...createAuthHeaders(options.token),
      ...(options.headers || {}),
    },
  });

  const rawText = await response.text();
  const payload = parseResponseBody(rawText);

  if (!response.ok) {
    throw new Error(
      extractMessage(payload, "We could not complete your request right now."),
    );
  }

  return payload;
}

export function getOAuthUrl(provider) {
  if (provider === "google") {
    return API_ENDPOINTS.loginGoogle;
  }

  if (provider === "apple") {
    return API_ENDPOINTS.loginApple;
  }

  return "";
}

export function loadStoredSession() {
  try {
    const rawSession = window.localStorage.getItem(AUTH_STORAGE_KEY);
    if (!rawSession) {
      return null;
    }

    const session = JSON.parse(rawSession);
    if (!isObject(session)) {
      return null;
    }

    return session;
  } catch {
    return null;
  }
}

export function saveStoredSession(session) {
  window.localStorage.setItem(AUTH_STORAGE_KEY, JSON.stringify(session));
  if (session?.token) {
    window.localStorage.setItem("authToken", session.token);
  }
  if (session?.user?.email) {
    window.localStorage.setItem("userEmail", session.user.email);
  }
  if (session?.user?.name) {
    window.localStorage.setItem("userName", session.user.name);
  }
}

export function clearStoredSession() {
  window.localStorage.removeItem(AUTH_STORAGE_KEY);
  window.localStorage.removeItem("authToken");
  window.localStorage.removeItem("userEmail");
  window.localStorage.removeItem("userName");
}

function buildSession(payload, fallbackUser = null) {
  const token = extractToken(payload);
  const apiUser = extractUser(payload);
  const user = apiUser || fallbackUser;

  return {
    token,
    user,
    raw: payload,
  };
}

export async function loginUser(credentials) {
  const payloadData = { ...credentials };
  const identifier = String(credentials.emailOrPhone || credentials.email || "").trim();

  if (identifier) {
    if (!credentials.email && !credentials.phone) {
      if (/^[+\d\s()-]{7,20}$/.test(identifier) && !identifier.includes("@")) {
        payloadData.phone = identifier;
      } else {
        payloadData.email = identifier;
      }
    }
  }

  const payload = await request(API_ENDPOINTS.login, {
    method: "POST",
    body: JSON.stringify(payloadData),
  });

  return buildSession(payload, { email: payloadData.email || identifier });
}

export async function registerUser(details) {
  const payload = await request(API_ENDPOINTS.register, {
    method: "POST",
    body: JSON.stringify(details),
  });

  return buildSession(payload, {
    name: details.name,
    email: details.email,
    phone: details.phone,
  });
}

export async function forgotPassword(details) {
  return request(API_ENDPOINTS.forgotPassword, {
    method: "POST",
    body: JSON.stringify(details),
  });
}

export async function resetPassword(details) {
  return request(API_ENDPOINTS.resetPassword, {
    method: "POST",
    body: JSON.stringify(details),
  });
}

export function getApiSuccessMessage(payload, fallbackMessage) {
  return extractMessage(payload, fallbackMessage);
}
