import { useState, useEffect } from "react";
import { FiMail, FiLock, FiSun, FiMoon } from "react-icons/fi";
import { useLogin } from "../services/useAuthService";
import { useNavigate } from "react-router-dom";

export default function LoginPage() {
  const navigate = useNavigate();
  // --- Initialize state based on whether 'dark' is already on the html tag ---
  const [isDark, setIsDark] = useState(() =>
    document.documentElement.classList.contains("dark"),
  );

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { login, loading, errorMessage } = useLogin();
  // --- Watch isDark changes and update the <html> tag ---
  useEffect(() => {
    if (isDark) {
      document.documentElement.classList.add("dark");
    } else {
      document.documentElement.classList.remove("dark");
    }
  }, [isDark]);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    try {
      await login({ email, password });
      navigate("/");
    } catch {
      // errorMessage is already updated by the hook
    }
  };
  
  return (
    /* Page Container (Cleaned up the theme wrapper wrapper) */
    <div className="flex min-h-screen items-center justify-center bg-bg-light p-6 transition-colors duration-300 dark:bg-bg-dark-hover">
      {/* Theme Toggle Switch */}
      <button
        onClick={() => setIsDark(!isDark)}
        type="button"
        className="absolute top-6 right-6 p-2 rounded-lg  bg-primary-normal dark:bg-primary-normal text-gray-600 dark:text-zinc-400 cursor-pointer hover:bg-primary-hover dark:hover:bg-primary-hover transition-all"
        aria-label="Toggle Theme"
      >
        {isDark ? (
          <FiSun className="w-5 h-5 text-white" />
        ) : (
          <FiMoon className="w-5 h-5 text-white" />
        )}
      </button>

      {/* Login Card */}
      <div className="w-full max-w-md space-y-8 rounded-xl border border-gray-100 dark:border-zinc-900 bg-bg-light-hover p-8 shadow-sm transition-all dark:bg-bg-dark">
        <div className="text-center">
          <h2 className="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
            Welcome back
          </h2>
          <p className="mt-2 text-sm text-gray-500 dark:text-zinc-400">
            Enter your credentials to access the leaderboard
          </p>
        </div>

        {errorMessage && (
          <div className="rounded-md bg-red-50 p-3 text-xs text-red-600 dark:bg-red-950/30 dark:text-red-400 border border-red-100 dark:border-red-900/50">
            {errorMessage}
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-5">
          <div className="space-y-1.5">
            <label className="text-xs font-medium text-gray-500 dark:text-zinc-400">
              EMAIL ADDRESS
            </label>
            <div className="relative flex items-center">
              <FiMail className="absolute left-3 text-gray-400 dark:text-zinc-500 w-4 h-4" />
              <input
                type="email"
                required
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="admin@web4jobs.com"
                className="w-full rounded-md border border-gray-200 bg-transparent py-2.5 pl-10 pr-4 text-sm text-gray-900 focus:border-blue-500 focus:outline-none dark:border-zinc-800 dark:text-white dark:focus:border-blue-500"
              />
            </div>
          </div>

          <div className="space-y-1.5">
            <div className="flex justify-between items-center">
              <label className="text-xs font-medium text-gray-500 dark:text-zinc-400">
                PASSWORD
              </label>
              <a href="#" className="text-xs text-blue-500 hover:underline">
                Forgot?
              </a>
            </div>
            <div className="relative flex items-center">
              <FiLock className="absolute left-3 text-gray-400 dark:text-zinc-500 w-4 h-4" />
              <input
                type="password"
                required
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="••••••••"
                className="w-full rounded-md border border-gray-200 bg-transparent py-2.5 pl-10 pr-4 text-sm text-gray-900 focus:border-blue-500 focus:outline-none dark:border-zinc-800 dark:text-white dark:focus:border-blue-500"
              />
            </div>
          </div>

          <button
            type="submit"
            disabled={loading}
            className="w-full py-2.5 px-4 bg-primary-normal text-white rounded-md text-sm font-medium tracking-wide transition-all hover:bg-primary-hover active:scale-[0.99] disabled:opacity-50 disabled:pointer-events-none cursor-pointer dark:bg-primary-normal dark:text-white dark:hover:bg-primary-hover"
          >
            {loading ? "Authenticating session..." : "Sign In"}
          </button>
        </form>
      </div>
    </div>
  );
}
