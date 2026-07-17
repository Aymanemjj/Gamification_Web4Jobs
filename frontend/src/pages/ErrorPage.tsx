import {
  Link,
  useNavigate,
  useRouteError,
  isRouteErrorResponse,
} from "react-router-dom";

export default function ErrorPage() {
  const error = useRouteError();
  const navigate = useNavigate();

  let status = 500;
  let title = "Unexpected Error";
  let description =
    "Something went wrong while processing your request.";

  let technicalDetails = "";

  if (isRouteErrorResponse(error)) {
    status = error.status;
    title = error.statusText || "Error";

    switch (error.status) {
      case 400:
        title = "Bad Request";
        description =
          "The request could not be processed because it was invalid.";
        break;

      case 401:
        title = "Unauthorized";
        description =
          "You must sign in before accessing this page.";
        break;

      case 403:
        title = "Access Denied";
        description =
          "You don't have permission to view this page.";
        break;

      case 404:
        title = "Page Not Found";
        description =
          "The page you're looking for doesn't exist or has been moved.";
        break;

      case 500:
        title = "Internal Server Error";
        description =
          "An unexpected server error occurred.";
        break;

      default:
        description = error.statusText;
    }

    technicalDetails = error.data
      ? JSON.stringify(error.data, null, 2)
      : "";
  } else if (error instanceof Error) {
    technicalDetails = error.message;
  }

  return (
    <div className="flex min-h-screen items-center justify-center bg-bg-light dark:bg-bg-dark px-6">
      <div className="w-full max-w-2xl rounded-xl border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-10 shadow-lg">

        <div className="text-center">

          <p className="text-primary-normal text-sm font-semibold tracking-[0.3em] uppercase">
            Error {status}
          </p>

          <h1 className="mt-3 text-5xl font-bold text-gray-900 dark:text-white">
            {title}
          </h1>

          <p className="mt-4 text-gray-600 dark:text-zinc-400 leading-relaxed">
            {description}
          </p>

        </div>

        {technicalDetails && (
          <div className="mt-8 rounded-lg border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-950/30 p-4">

            <h2 className="text-sm font-semibold text-red-700 dark:text-red-400">
              Technical Details
            </h2>

            <pre className="mt-2 overflow-x-auto whitespace-pre-wrap text-sm text-red-600 dark:text-red-300">
              {technicalDetails}
            </pre>

          </div>
        )}

        <div className="mt-8 flex justify-center gap-4">

          <button
            onClick={() => navigate(-1)}
            className="rounded-md border border-gray-300 dark:border-zinc-700 px-5 py-2.5 text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-zinc-800 transition"
          >
            ← Go Back
          </button>

          <Link
            to="/"
            className="rounded-md bg-primary-normal px-5 py-2.5 text-white hover:bg-primary-hover transition"
          >
            Go Home
          </Link>

        </div>

      </div>
    </div>
  );
}