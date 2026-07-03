import { FiAward, FiBriefcase, FiFileText, FiGift, FiLock, FiCheckCircle } from "react-icons/fi";
import { type ReactNode } from "react";

type Reward = {
    icon: ReactNode
    title: string
    desc: string
    requirement: string
    progress: number
    unlocked: boolean
}

const rewards: Reward[] = [
    { icon: <FiAward />, title: "Premium Course Access", desc: "Unlock all premium courses for 1 month", requirement: "Reach Top 25%", progress: 80, unlocked: false },
    { icon: <FiBriefcase />, title: "Interview with Tech Startup", desc: "Get a guaranteed interview with our partner companies", requirement: "Reach Top 10%", progress: 94, unlocked: false },
    { icon: <FiFileText />, title: "Professional Certificate", desc: "Receive a verified certificate for your skills", requirement: "Complete 10 Courses", progress: 100, unlocked: true },
    { icon: <FiGift />, title: "Mentorship Session", desc: "1-on-1 session with an industry expert", requirement: "Reach Level 25", progress: 96, unlocked: false },
    { icon: <FiBriefcase />, title: "Job Offer Fast Track", desc: "Skip the resume screen for select positions", requirement: "Rank #1 in League", progress: 60, unlocked: false },
    { icon: <FiAward />, title: "Exclusive Community Access", desc: "Join our private Discord for top performers", requirement: "Top 5% Overall", progress: 100, unlocked: true },
]

export default function Rewards() {
    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">Rewards</h2>
                <p className="text-small mt-1 text-muted">Unlock exclusive opportunities by climbing the ranks</p>
            </div>

            <div className="grid grid-cols-3 gap-4">
                {rewards.map((r, i) => (
                    <div key={i} className={`border rounded-2xl p-6 flex flex-col gap-4 ${r.unlocked ? "border-primary-normal/40 dark:bg-bg-dark-hover" : "border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover"}`}>
                        <div className="flex justify-between items-start">
                            <div className={`size-12 rounded-xl flex items-center justify-center text-xl ${r.unlocked ? "bg-primary-normal text-white" : "bg-gray-100 dark:bg-bg-dark text-muted"}`}>
                                {r.icon}
                            </div>
                            <span className={`text-xl ${r.unlocked ? "text-primary-normal" : "text-muted"}`}>
                                {r.unlocked ? <FiCheckCircle /> : <FiLock />}
                            </span>
                        </div>

                        <div>
                            <h3 className="font-semibold text-sm dark:text-white">{r.title}</h3>
                            <p className="text-muted text-xs mt-1">{r.desc}</p>
                        </div>

                        <div className="space-y-1.5">
                            <div className="flex justify-between text-xs">
                                <span className="text-muted">Requirement</span>
                                <span className={`font-semibold ${r.unlocked ? "text-teal-500" : "dark:text-white"}`}>{r.requirement}</span>
                            </div>
                            {!r.unlocked && (
                                <>
                                    <div className="flex justify-between text-xs text-muted">
                                        <span>Progress</span>
                                        <span>{r.progress}%</span>
                                    </div>
                                    <div className="w-full h-1.5 bg-gray-100 dark:bg-bg-dark rounded-full overflow-hidden">
                                        <div className="h-full bg-primary-normal rounded-full" style={{ width: `${Math.min(r.progress, 100)}%` }} />
                                    </div>
                                </>
                            )}
                        </div>

                        {r.unlocked ? (
                            <button className="w-full py-3 rounded-xl bg-primary-normal text-white text-small font-medium">
                                Claim Reward
                            </button>
                        ) : (
                            <button disabled className="w-full py-3 rounded-xl bg-gray-100 dark:bg-bg-dark text-muted text-small font-medium cursor-not-allowed">
                                Locked
                            </button>
                        )}
                    </div>
                ))}
            </div>

            <div className="light:border light:border-border  rounded-2xl p-5 bg-primary-normal/5 flex gap-4 items-start">
                <div className="size-12 rounded-xl bg-primary-normal flex items-center justify-center text-white text-xl shrink-0">
                    <FiGift />
                </div>
                <div>
                    <h3 className="font-semibold dark:text-white">Keep Climbing!</h3>
                    <p className="text-small text-muted mt-0.5">Continue completing missions and challenges to unlock more exclusive rewards and opportunities.</p>
                    <div className="flex items-center gap-4 mt-3 text-small dark:text-white">
                        <span className="flex items-center gap-1.5"><span className="size-2 rounded-full bg-teal-500 inline-block" /> 2 rewards unlocked</span>
                        <span className="flex items-center gap-1.5"><span className="size-2 rounded-full bg-amber-400 inline-block" /> 4 rewards in progress</span>
                    </div>
                </div>
            </div>
        </div>
    )
}