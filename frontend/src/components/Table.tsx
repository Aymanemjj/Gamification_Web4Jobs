import { useState } from "react";
import type { AdminUserManagementTableRow as Row } from "../types.ts";
import { changeUserRole, toggleActive } from "../services/useUserService.ts";
import { GetAllRoles } from "../services/useRoleService.ts";

export default function Table({ table }: { table: Row[] }) {
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(10);
  const [openRoleMenu, setOpenRoleMenu] = useState<number | null>(null);

  const { roles, loading: rolesLoading } = GetAllRoles();

  if (!table || table.length === 0) {
    return <div className="p-4 text-center text-muted">No users found.</div>;
  }

  const totalPages = Math.ceil(table.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const paginatedRows = table.slice(startIndex, endIndex);

  const handlePageSizeChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    setItemsPerPage(Number(e.target.value));
    setCurrentPage(1);
  };

  const handleRoleSelect = (userId: number, roleName: string) => {
    changeUserRole(userId, roleName);
    setOpenRoleMenu(null);
  };

  return (
    <div className="space-y-4">
      <table className="w-full text-small">
        <thead className="text-smaller text-muted">
          <tr>
            <th className="text-left p-4 font-normal">USER</th>
            <th className="text-left p-4 font-normal">EMAIL</th>
            <th className="text-left p-4 font-normal">ROLE</th>
            <th className="text-left p-4 font-normal">Actions</th>
          </tr>
        </thead>
        <tbody>
          {paginatedRows.map((r) => (
            <tr key={r.id} className="border-b dark:border-bg-dark-hover border-gray-100">
              <td className="p-4 font-medium dark:text-white">{r.name}</td>
              <td className="p-4 dark:text-white">{r.email}</td>
              <td className="p-4 dark:text-white">{r.role}</td>
              <td className="p-4 dark:text-white">
                <div className="flex gap-2 relative">
                  <button onClick={() => toggleActive(r.id)} className="p-2 bg-red-600 rounded-md cursor-pointer hover:bg-red-700 text-white">
                    {r.active ? "Ban" : "Unban"}
                  </button>

                  <div className="relative">
                    <button
                      onClick={() => setOpenRoleMenu(openRoleMenu === r.id ? null : r.id)}
                      className="p-2 bg-yellow-600 rounded-md cursor-pointer hover:bg-yellow-700 text-white"
                    >
                      Change role
                    </button>

                    {openRoleMenu === r.id && (
                      <div className="absolute z-10 mt-1 w-32 bg-white dark:bg-zinc-800 border dark:border-zinc-700 rounded-md shadow-lg">
                        {rolesLoading && (
                          <div className="px-3 py-2 text-small text-muted">Loading...</div>
                        )}
                        {roles?.map((role: { id: number; name: string }) => (
                          <button
                            key={role.id}
                            onClick={() => handleRoleSelect(r.id, role.name)}
                            className="block w-full text-left px-3 py-2 text-small hover:bg-gray-100 dark:hover:bg-bg-dark-hover dark:text-white cursor-pointer"
                          >
                            {role.name}
                          </button>
                        ))}
                      </div>
                    )}
                  </div>
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <div className="flex items-center justify-between p-4 border-t border-gray-100 dark:border-bg-dark-hover text-small text-muted">
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
  );
}