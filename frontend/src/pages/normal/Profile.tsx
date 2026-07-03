import { FiBook, FiCode, FiAward, FiCalendar, FiUser } from "react-icons/fi";

export default function Profile() {

    const stats = [
        { icon: <FiBook />, label: "Courses Completed", value: 24, color: "text-blue-500" },
        { icon: <FiCode />, label: "Projects Built", value: 12, color: "text-teal-500" },
        { icon: <FiAward />, label: "Quizzes Passed", value: 48, color: "text-purple-500" },
        { icon: <FiCalendar />, label: "Days Streak", value: 32, color: "text-amber-500" },
    ]

    const timeline = [
        { label: "Completed React Advanced course", time: "2 hours ago", xp: "+250 XP" },
        { label: "Finished Database Design quiz", time: "5 hours ago", xp: "+100 XP" },
        { label: "Built E-commerce Project", time: "1 day ago", xp: "+500 XP" },
        { label: 'Earned "Code Master" badge', time: "2 days ago", xp: "+200 XP" },
    ]

    const badges = [
        { emoji: "⚡", label: "Quick Learner", unlocked: true },
        { emoji: "💻", label: "Code Master", unlocked: true },
        { emoji: "🔥", label: "100 Day Streak", unlocked: false },
        { emoji: "🤝", label: "Team Player", unlocked: true },
        { emoji: "🐛", label: "Bug Hunter", unlocked: true },
        { emoji: "🦉", label: "Night Owl", unlocked: false },
    ]

    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">Profile</h2>
                <p className="text-small mt-1 text-muted">Your journey and achievements</p>
            </div>

            <div className="grid grid-cols-3 gap-4">

                <div className="border border-border dark:border-bg-dark-hover dark:bg-bg-dark-hover rounded-2xl p-6 flex flex-col items-center gap-4">
                    <div className="rounded-full bg-primary-normal size-24 flex items-center justify-center">
                        <FiUser className="text-white text-4xl" size={32} />
                    </div>
                    <div className="text-center">
                        <h3 className="font-semibold text-base dark:text-white">Alex Morgan</h3>
                        <p className="text-muted text-small">@alexmorgan</p>
                    </div>
                    <div className="w-full mt-2 space-y-2">
                        <div className="flex justify-between text-small">
                            <span className="text-muted">Level</span>
                            <span className="text-primary-normal font-semibold">24</span>
                        </div>
                        <div className="flex justify-between text-xs text-muted">
                            <span>9,850 XP</span>
                            <span>10,000 XP</span>
                        </div>
                        <div className="w-full h-2 bg-gray-100 dark:bg-bg-dark-hover rounded-full overflow-hidden">
                            <div className="h-full bg-primary-normal rounded-full" style={{ width: "98.5%" }} />
                        </div>
                    </div>
                </div>

                <div className="col-span-2 flex flex-col gap-4">
                    <div className="grid grid-cols-2 gap-4">
                        {stats.map(s => (
                            <div key={s.label} className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-5 flex items-center gap-4">
                                <div className="bg-gray-100 dark:bg-bg-dark-hover rounded-xl p-2">
                                    <span className={`text-xl ${s.color}`}>{s.icon}</span>
                                </div>
                                <div>
                                    <p className="text-2xl font-semibold dark:text-white">{s.value}</p>
                                    <p className="text-muted text-small">{s.label}</p>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6 flex-1">
                        <h4 className="font-semibold mb-4 dark:text-white">Activity Timeline</h4>
                        <div className="space-y-4">
                            {timeline.map((item, i) => (
                                <div key={i}>
                                    <div className="flex justify-between items-start">
                                        <div className="flex gap-3 items-start">
                                            <span className="mt-1.5 size-2 rounded-full bg-primary-normal shrink-0" />
                                            <div>
                                                <p className="text-small font-medium dark:text-white">{item.label}</p>
                                                <p className="text-xs text-muted">{item.time}</p>
                                            </div>
                                        </div>
                                        <span className="text-small text-teal-500 font-medium">{item.xp}</span>
                                    </div>
                                    {i < timeline.length - 1 && <hr className="mt-4 border-border dark:border-bg-dark-hover" />}
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

            <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-6">
                <h4 className="font-semibold mb-4 dark:text-white">Badges</h4>
                <div className="grid grid-cols-6 gap-4">
                    {badges.map(b => (
                        <div key={b.label} className={`flex flex-col items-center gap-2 bg-gray-100 dark:bg-bg-dark-hover rounded-2xl p-4 ${!b.unlocked ? "opacity-40" : ""}`}>
                            <span className="text-3xl">{b.emoji}</span>
                            <p className="text-xs text-muted text-center">{b.label}</p>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    )
}