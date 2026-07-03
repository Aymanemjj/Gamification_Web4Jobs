import {type LeaderBoardRow as Row} from "../types.ts";

function medal(rank: number) {
    if (rank === 1) return "🥇 "
    if (rank === 2) return "🥈 "
    if (rank === 3) return "🥉 "
    return null
}

export default function LeaderboardTable({ table }: { table: Row[] }) {
    return (
        <table className="w-full text-small">
            <thead className="text-smaller text-muted">
            <tr>
                <th className="text-left p-4 font-normal">RANK</th>
                <th className="text-left p-4 font-normal">USER</th>
                <th className="text-left p-4 font-normal">XP POINTS</th>
                <th className="text-left p-4 font-normal">CHANGE</th>
            </tr>
            </thead>
            <tbody>
            {table.map(r => (
                <tr key={r.rank} className={`border-b dark:border-bg-dark-hover border-gray-100 ${r.isYou ? "bg-gray-50 dark:bg-bg-dark-hover" : ""}`}>
                    <td className="p-4 text-gray-500">{medal(r.rank)}#{r.rank}</td>
                    <td className={`p-4 font-medium ${r.isYou ? "text-primary-normal" : "dark:text-white"}`}>{r.name}</td>
                    <td className="p-4 dark:text-white">{r.xp}</td>
                    <td className={`p-4 ${r.change ? "text-green-600" : "text-gray-400"}`}>
                        {r.change ? `↑ ${r.change}` : "—"}
                    </td>
                </tr>
            ))}
            </tbody>
        </table>
    )
}