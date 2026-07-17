import { useState } from "react";
import { GetMetricKeys } from "../../services/useMetricKeysService";

export default function MetricKeys() {
  const { table, loading, error } = GetMetricKeys();
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(10);

  if (loading) {
    return <div className="p-4 text-center text-muted">Loading...</div>;
  }

  if (error) {
    return <div className="p-4 text-center text-muted">{error}</div>;
  }

  if (!table || table.length === 0) {
    return <div className="p-4 text-center text-muted">No MetricKeys found.</div>;
  }

  const totalPages = Math.ceil(table.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const paginatedRows = table.slice(startIndex, endIndex);

  const handlePageSizeChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    setItemsPerPage(Number(e.target.value));
    setCurrentPage(1); 
  };

  return (
    <>
      <h2 className="text-2xl font-bold dark:text-white">Metric Keys</h2>

      <div className="space-y-4">
        {/* Table */}
        <table className="w-full text-small">
          <thead className="text-smaller text-muted">
            <tr>
              <th className="text-left p-4 font-normal">Name</th>
              <th className="text-left p-4 font-normal">Platform</th>
              <th className="text-left p-4 font-normal">Rules</th>
              <th className="text-left p-4 font-normal">Actions</th>
            </tr>
          </thead>
          <tbody>
            {paginatedRows.map((r) => (
              <tr key={r.id} className="border-b dark:border-bg-dark-hover border-gray-100">
                <td className="p-4 font-medium dark:text-white">{r.name}</td>
                <td className="p-4 dark:text-white">{r.platform}</td>
                <td className="p-4 dark:text-white">{r.rules}</td>
                <td className="p-4 dark:text-white">
                  <div className="flex gap-2">
                    <button className="p-2 bg-red-600 rounded-md cursor-pointer hover:bg-red-700 text-white">
                      Delete
                    </button>
                    <button className="p-2 bg-yellow-600 rounded-md cursor-pointer hover:bg-yellow-700 text-white">
                      Edit
                    </button>
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>

        {/* --- Pagination Footer --- */}
        <div className="flex items-center justify-between p-4 border-t border-gray-100 dark:border-bg-dark-hover text-small text-muted">
          
          {/* Dynamic Items Indicator + Dropdown */}
          <div className="flex items-center gap-4">
            <div>
              Showing <span className="font-medium dark:text-white">{startIndex + 1}</span> to{" "}
              <span className="font-medium dark:text-white">
                {Math.min(endIndex, table.length)}
              </span>{" "}
              of <span className="font-medium dark:text-white">{table.length}</span> users
            </div>
            
            <div className="flex items-center gap-1.5">
              <span>Show</span>
              <select 
                value={itemsPerPage} 
                onChange={handlePageSizeChange}
                className="p-1 px-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-700 dark:text-white text-xs focus:outline-none cursor-pointer"
              >
                <option value={5}>5</option>
                <option value={10}>10</option>
                <option value={20}>20</option>
                <option value={50}>50</option>
              </select>
            </div>
          </div>

          {/* Navigation Buttons */}
          <div className="flex gap-2">
            <button
              onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
              disabled={currentPage === 1}
              className="p-2 px-3 border rounded-md disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer hover:bg-gray-50 dark:hover:bg-bg-dark-hover dark:text-white"
            >
              Previous
            </button>
            
            <div className="flex items-center px-2 dark:text-white">
              Page {currentPage} of {totalPages || 1}
            </div>

            <button
              onClick={() => setCurrentPage((prev) => Math.min(prev + 1, totalPages))}
              disabled={currentPage === totalPages || totalPages === 0}
              className="p-2 px-3 border rounded-md disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer hover:bg-gray-50 dark:hover:bg-bg-dark-hover dark:text-white"
            >
              Next
            </button>
          </div>
        </div>
      </div>
    </>
  );
}