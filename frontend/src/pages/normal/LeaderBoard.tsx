import BasicTab from "../../components/BasicTab.tsx";
import LeaderboardTable from "../../components/LeaderBoardTable.tsx";
import { useState } from "react";
import {type LeaderBoardRow as Row} from "../../types.ts";


type Tab = "weekly" | "monthly" | "allTime"




const table: Record<Tab, Row[]> = {
    weekly: [
        { rank: 1, name: "Sarah Chen", xp: "12,450 XP", change: 2 },
        { rank: 2, name: "Marcus Johnson", xp: "11,890 XP", change: 1 },
        { rank: 3, name: "Elena Rodriguez", xp: "11,230 XP", change: 1 },
        { rank: 4, name: "David Kim", xp: "10,875 XP", change: null },
        { rank: 5, name: "Aisha Patel", xp: "10,420 XP", change: 3 },
        { rank: 6, name: "You", xp: "9,850 XP", change: 1, isYou: true },
        { rank: 7, name: "James Wilson", xp: "9,640 XP", change: 2 },
    ],
    monthly: [
        { rank: 1, name: "Sarah Chen", xp: "52,450 XP", change: 2 },
        { rank: 2, name: "Marcus Johnson", xp: "48,890 XP", change: 1 },
        { rank: 3, name: "Elena Rodriguez", xp: "45,230 XP", change: 1 },
        { rank: 4, name: "David Kim", xp: "41,875 XP", change: null },
        { rank: 5, name: "Aisha Patel", xp: "38,420 XP", change: 3 },
        { rank: 6, name: "You", xp: "35,850 XP", change: 1, isYou: true },
        { rank: 7, name: "James Wilson", xp: "32,640 XP", change: 2 },
    ],
    allTime: [
        { rank: 1, name: "Sarah Chen", xp: "120,450 XP", change: 2 },
        { rank: 2, name: "Marcus Johnson", xp: "115,890 XP", change: 1 },
        { rank: 3, name: "Elena Rodriguez", xp: "110,230 XP", change: 1 },
        { rank: 4, name: "David Kim", xp: "98,875 XP", change: null },
        { rank: 5, name: "Aisha Patel", xp: "87,420 XP", change: 3 },
        { rank: 6, name: "You", xp: "75,850 XP", change: 1, isYou: true },
        { rank: 7, name: "James Wilson", xp: "68,640 XP", change: 2 },
    ],
}

const tabs: { label: string, value: Tab }[] = [
    { label: "Weekly", value: "weekly" },
    { label: "Monthly", value: "monthly" },
    { label: "All Time", value: "allTime" },
]

export default function LeaderBoard() {
    const [tab, setTab] = useState<Tab>("weekly")

    return (
        <div className="p-8 space-y-6 min-h-screen">
            <div>
                <h2 className="text-large dark:text-white font-semibold">Leaderboard</h2>
                <p className="text-small mt-1 text-muted">Compete with other candidates and climb the ranks</p>
            </div>
            <div className="flex gap-2">
                {tabs.map(t => (
                    <BasicTab key={t.value} label={t.label} isActive={tab === t.value} onClick={() => setTab(t.value)} />
                ))}
            </div>
            <div className="w-full border border-border dark:border-bg-dark-hover rounded-2xl">
                <LeaderboardTable table={table[tab]} />
            </div>
        </div>
    )
}