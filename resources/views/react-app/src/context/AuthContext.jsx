import { createContext, useContext, useState } from "react";
import {
  clearStoredSession,
  loadStoredSession,
  loginUser,
  registerUser,
  saveStoredSession,
} from "../utils/auth";

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
  const [session, setSession] = useState(() => loadStoredSession());

  const login = async (credentials) => {
    const nextSession = await loginUser(credentials);
    saveStoredSession(nextSession);
    setSession(nextSession);
    return nextSession;
  };

  const register = async (details) => {
    const nextSession = await registerUser(details);
    saveStoredSession(nextSession);
    setSession(nextSession);
    return nextSession;
  };

  const logout = () => {
    clearStoredSession();
    setSession(null);
  };

  const value = {
    isAuthenticated: Boolean(session?.token || session?.user),
    session,
    user: session?.user || null,
    token: session?.token || "",
    login,
    register,
    logout,
  };

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  const context = useContext(AuthContext);

  if (!context) {
    throw new Error("useAuth must be used within an AuthProvider");
  }

  return context;
}
