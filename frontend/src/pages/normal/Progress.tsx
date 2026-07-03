import { LineChart, Line, XAxis, YAxis, CartesianGrid, ResponsiveContainer } from "recharts";

const stats = [
    { label: "Total XP Earned", value: "9,850", badge: "+8.2%" },
    { label: "Weekly Activity", value: "24h", badge: "+12%" },
    { label: "Completion Rate", value: "87%", badge: "+3%" },
    { label: "Current Streak", value: "32 days", badge: "Record!" },
]

const xpData = [
    { day: "Mon", xp: 8200 },
    { day: "Tue", xp: 8500 },
    { day: "Wed", xp: 8600 },
    { day: "Thu", xp: 8900 },
    { day: "Fri", xp: 9200 },
    { day: "Sat", xp: 9600 },
    { day: "Sun", xp: 9850 },
]

const skills = [
    { name: "Frontend Development", pct: 85, color: "#534AB7" },
    { name: "Backend Development", pct: 70, color: "#1D9E75" },
    { name: "Data Structures", pct: 65, color: "#A855F7" },
    { name: "System Design", pct: 55, color: "#F59E0B" },
    { name: "Database Management", pct: 75, color: "#EC4899" },
]

const heatmap = Array.from({ length: 5 }, () =>
    Array.from({ length: 7 }, () => Math.floor(Math.random() * 5))
)

const heatColor = (v: number) => {
    const shades = ["#E8E6F8", "#C4BEF0", "#9F97E4", "#7A70D8", "#534AB7"]
    return shades[v]
}

export default function Progress() {
    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">Progress Dashboard</h2>
                <p className="text-small mt-1 text-muted">Track your learning journey and skill development</p>
            </div>

            <div className="grid grid-cols-4 gap-4">
                {stats.map(s => (
                    <div key={s.label} className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-5">
                        <p className="text-small text-muted">{s.label}</p>
                        <p className="text-2xl font-bold mt-1 dark:text-white">
                            {s.value}{" "}
                            <span className="text-small font-medium text-teal-500">{s.badge}</span>
                        </p>
                    </div>
                ))}
            </div>

            <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6">
                <h3 className="font-semibold mb-4 dark:text-white">XP Growth (Last 7 Days)</h3>
                <ResponsiveContainer width="100%" height={260}>
                    <LineChart data={xpData}>
                        <CartesianGrid strokeDasharray="3 3" stroke="#374151" />
                        <XAxis dataKey="day" tick={{ fontSize: 12, fill: "#888" }} axisLine={false} tickLine={false} />
                        <YAxis tick={{ fontSize: 12, fill: "#888" }} axisLine={false} tickLine={false} domain={[0, 10000]} ticks={[0, 2500, 5000, 7500, 10000]} />
                        <Line type="monotone" dataKey="xp" stroke="#534AB7" strokeWidth={2} dot={{ fill: "#534AB7", r: 4 }} />
                    </LineChart>
                </ResponsiveContainer>
            </div>

            <div className="grid grid-cols-3 gap-4">
                <div className="col-span-2 border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6 space-y-5">
                    <h3 className="font-semibold dark:text-white">Skill Levels</h3>
                    {skills.map(s => (
                        <div key={s.name} className="space-y-1.5">
                            <div className="flex justify-between text-small">
                                <span className="dark:text-white">{s.name}</span>
                                <span className="text-muted">{s.pct}%</span>
                            </div>
                            <div className="w-full h-2 bg-gray-100 dark:bg-bg-dark-hover rounded-full overflow-hidden">
                                <div className="h-full rounded-full" style={{ width: `${s.pct}%`, background: s.color }} />
                            </div>
                        </div>
                    ))}
                </div>

                <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6">
                    <h3 className="font-semibold mb-4 dark:text-white">Activity Heatmap</h3>
                    <div className="flex flex-col gap-1.5">
                        {heatmap.map((row, r) => (
                            <div key={r} className="flex gap-1.5">
                                {row.map((val, c) => (
                                    <div
                                        key={c}
                                        className="size-8 rounded-md"
                                        style={{ background: heatColor(val) }}
                                    />
                                ))}
                            </div>
                        ))}
                    </div>
                    <div className="flex items-center justify-between mt-4 text-xs text-muted">
                        <span>Less</span>
                        <div className="flex gap-1">
                            {["#E8E6F8", "#C4BEF0", "#9F97E4", "#7A70D8", "#534AB7"].map(c => (
                                <div key={c} className="size-3 rounded-sm" style={{ background: c }} />
                            ))}
                        </div>
                        <span>More</span>
                    </div>
                </div>
            </div>
        </div>
    )
}