import {type Achievement, type Rarity} from "../../types.ts"


const achievements: Achievement[] = [
    { emoji: "👶", title: "First Steps", desc: "Complete your first course", rarity: "common", unlocked: true },
    { emoji: "⚡", title: "Quick Learner", desc: "Finish 5 courses in a week", rarity: "common", unlocked: true },
    { emoji: "⚔️", title: "Code Warrior", desc: "Solve 50 coding challenges", rarity: "rare", unlocked: true },
    { emoji: "💻", title: "Code Master", desc: "Achieve 10,000 XP", rarity: "legendary", unlocked: false },
    { emoji: "🦉", title: "Night Owl", desc: "Complete tasks after midnight 10 times", rarity: "common", unlocked: true },
    { emoji: "💯", title: "Perfectionist", desc: "Get 100% on 10 quizzes", rarity: "common", unlocked: false },
    { emoji: "🔥", title: "Unstoppable", desc: "Maintain a 100-day streak", rarity: "common", unlocked: false },
    { emoji: "🤝", title: "Team Player", desc: "Help 20 peers with code reviews", rarity: "rare", unlocked: true },
    { emoji: "🚀", title: "Speed Demon", desc: "Complete a challenge in under 5 minutes", rarity: "common", unlocked: true },
    { emoji: "🐛", title: "Bug Hunter", desc: "Find and report 10 bugs", rarity: "rare", unlocked: true },
    { emoji: "🐦", title: "Early Bird", desc: "Complete tasks before 6 AM 10 times", rarity: "common", unlocked: false },
    { emoji: "👑", title: "Legend", desc: "Reach rank #1 on the leaderboard", rarity: "legendary", unlocked: false },
]

const rarityStyles: Record<Rarity, { badge: string, border: string }> = {
    common: {
        badge: "bg-gray-100 dark:bg-bg-dark-hover text-gray-500",
        border: "border-border dark:border-bg-dark-hover",
    },
    rare: {
        badge: "bg-primary-normal/10 text-primary-normal",
        border: "border-primary-normal",
    },
    legendary: {
        badge: "bg-amber-100 dark:bg-amber-900/30 text-amber-500",
        border: "border-amber-400",
    },
}

export default function Achievements() {
    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">Achievements</h2>
                <p className="text-small mt-1 text-muted">Unlock badges by completing special tasks</p>
            </div>

            <div className="flex items-center gap-4 text-small dark:text-white">
                <span className="flex items-center gap-1.5"><span className="size-3 rounded-full bg-gray-400 inline-block" /> Common</span>
                <span className="flex items-center gap-1.5"><span className="size-3 rounded-full bg-primary-normal inline-block" /> Rare</span>
                <span className="flex items-center gap-1.5"><span className="size-3 rounded-full bg-amber-400 inline-block" /> Legendary</span>
            </div>

            <div className="grid grid-cols-4 gap-4">
                {achievements.map((a, i) => (
                    <div
                        key={i}
                        className={`border dark:bg-bg-dark-hover rounded-2xl p-6 flex flex-col items-center gap-3 text-center transition-opacity ${rarityStyles[a.rarity].border} ${!a.unlocked ? "opacity-40" : ""}`}
                    >
                        <div className={`size-16 rounded-full flex items-center justify-center text-3xl ${a.unlocked ? "bg-gray-700" : "bg-gray-200 dark:bg-bg-dark-hover"}`}>
                            {a.emoji}
                        </div>
                        <div>
                            <h3 className="font-semibold text-sm dark:text-white">{a.title}</h3>
                            <p className="text-muted text-xs mt-0.5">{a.desc}</p>
                        </div>
                        <span className={`text-xs font-medium px-3 py-1 rounded-md uppercase tracking-wide ${rarityStyles[a.rarity].badge}`}>
                            {a.rarity}
                        </span>
                    </div>
                ))}
            </div>
        </div>
    )
}