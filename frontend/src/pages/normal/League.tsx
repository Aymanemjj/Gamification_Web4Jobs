import { FiTrendingUp, FiTrendingDown } from "react-icons/fi";

const standings = [
    { rank: 1, name: "Sarah Chen", xp: 11240, trend: "up" },
    { rank: 2, name: "Marcus Johnson", xp: 11180, trend: "down" },
    { rank: 3, name: "Elena Rodriguez", xp: 10920, trend: "up" },
    { rank: 4, name: "David Kim", xp: 10560, trend: null },
    { rank: 5, name: "Aisha Patel", xp: 10320, trend: "up" },
    { rank: 6, name: "You", xp: 9850, trend: "up", isYou: true },
    { rank: 7, name: "James Wilson", xp: 9640, trend: "down" },
    { rank: 8, name: "Maria Garcia", xp: 9380, trend: null },
]

const leagues = [
    { name: "Diamond", xp: "20,000+ XP", color: "bg-blue-400" },
    { name: "Platinum", xp: "15,000+ XP", color: "bg-gray-400" },
    { name: "Gold", xp: "10,000+ XP", color: "bg-amber-400", active: true },
    { name: "Silver", xp: "5,000+ XP", color: "bg-gray-300" },
    { name: "Bronze", xp: "0+ XP", color: "bg-orange-400" },
]

export default function League() {
    const myXp = 9850
    const nextXp = 15000

    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">League</h2>
                <p className="text-small mt-1 text-muted">Compete in your league and climb to higher ranks</p>
            </div>

            <div className="grid grid-cols-3 gap-4">
                <div className="col-span-2 flex flex-col gap-4">

                    <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6">
                        <div className="flex justify-between items-start">
                            <div>
                                <h3 className="font-semibold dark:text-white">Current League</h3>
                                <p className="text-muted text-small">Rank #6 of 50 players</p>
                            </div>
                            <div className="size-12 rounded-full bg-amber-400 flex items-center justify-center">
                                <i className="ti ti-trophy text-white text-xl" />
                            </div>
                        </div>
                        <p className="text-4xl font-bold mt-4 dark:text-white">Gold <span className="text-2xl font-normal text-muted">League</span></p>
                        <div className="grid grid-cols-3 mt-6 pt-4 border-t border-border dark:border-bg-dark  text-small">
                            <div>
                                <p className="text-muted">Promotion Zone</p>
                                <p className="font-semibold text-teal-500 mt-1">Top 10</p>
                            </div>
                            <div>
                                <p className="text-muted">Safe Zone</p>
                                <p className="font-semibold mt-1 dark:text-white">11-40</p>
                            </div>
                            <div>
                                <p className="text-muted">Demotion Zone</p>
                                <p className="font-semibold text-amber-500 mt-1">Bottom 10</p>
                            </div>
                        </div>
                    </div>

                    <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6">
                        <div className="flex justify-between items-center mb-4">
                            <h3 className="font-semibold dark:text-white">League Standings</h3>
                            <p className="text-small text-muted">Resets in: <span className="text-primary-normal font-medium">2d 14h</span></p>
                        </div>
                        <div className="flex flex-col gap-1">
                            {standings.map(p => (
                                <div
                                    key={p.rank}
                                    className={`flex items-center justify-between px-4 py-3 rounded-xl border-l-2 ${p.isYou ? "bg-primary-normal/5 border-primary-normal" : "border-teal-400"}`}
                                >
                                    <div className="flex items-center gap-4">
                                        <span className={`text-small font-semibold w-6 ${p.rank <= 3 ? "text-amber-500" : "text-muted"}`}>#{p.rank}</span>
                                        <span className="text-small font-medium dark:text-white">{p.name}</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-small text-muted">
                                        <span>{p.xp.toLocaleString()} XP</span>
                                        {p.trend === "up" && <FiTrendingUp className="text-teal-500" />}
                                        {p.trend === "down" && <FiTrendingDown className="text-amber-500" />}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                <div className="flex flex-col gap-4">
                    <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6 space-y-3">
                        <h3 className="font-semibold dark:text-white">All Leagues</h3>
                        {leagues.map(l => (
                            <div key={l.name} className={`flex items-center gap-3 p-3 rounded-xl ${l.active ? "bg-primary-normal/10 border border-primary-normal/30" : ""}`}>
                                <div className={`size-8 rounded-full ${l.color}`} />
                                <div>
                                    <p className="text-small font-semibold dark:text-white">{l.name}</p>
                                    <p className="text-xs text-muted">{l.xp}</p>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div className="light:border light:border-border  rounded-2xl p-6 bg-primary-normal/5 space-y-3">
                        <p className="text-small text-muted">Next League</p>
                        <p className="text-2xl font-bold dark:text-white">Platinum</p>
                        <p className="text-small text-muted">Unlock at 15,000 XP</p>
                        <div className="space-y-1">
                            <div className="flex justify-between text-xs text-muted">
                                <span>{myXp.toLocaleString()} XP</span>
                                <span>{nextXp.toLocaleString()} XP</span>
                            </div>
                            <div className="w-full h-2 bg-white dark:bg-bg-dark-hover rounded-full overflow-hidden">
                                <div className="h-full bg-primary-normal rounded-full" style={{ width: `${(myXp / nextXp) * 100}%` }} />
                            </div>
                            <p className="text-small text-primary-normal font-medium text-center">
                                {(nextXp - myXp).toLocaleString()} XP remaining
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}