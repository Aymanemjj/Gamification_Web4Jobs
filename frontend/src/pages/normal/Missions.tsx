import { useState } from "react";
import MissionCard from "../../components/MissionCard.tsx";
import BasicTab from "../../components/BasicTab.tsx";
import {type Mission} from "../../types.ts"

type Tab = "daily" | "weekly"

const missions: Record<Tab, Mission[]> = {
    daily: [
        { title: "Complete 3 React Challenges", desc: "Finish three coding challenges focused on React hooks", xp: 150, progress: 66 },
        { title: "Pass JavaScript Quiz", desc: "Score at least 80% on the advanced JavaScript quiz", xp: 100, progress: 100 },
        { title: "Code Review Challenge", desc: "Review and provide feedback on 5 peer submissions", xp: 200, progress: 0 },
    ],
    weekly: [
        { title: "Build a Full Stack App", desc: "Complete a full stack project using React and Node", xp: 500, progress: 30 },
        { title: "Contribute to Open Source", desc: "Submit a pull request to any open source project", xp: 300, progress: 0 },
    ]
}

const tabs : { label: string, value: Tab}[]=[
    { label: "Daily", value: "daily" },
    { label: "Weekly", value: "weekly" },
]


export default function Missions() {
    const [tab, setTab] = useState<"daily" | "weekly">("daily")

    return (
        <div className="p-8 space-y-6">
            <div>
                <h2 className="text-large font-semibold dark:text-white">Missions</h2>
                <p className="text-small mt-1 text-muted">Complete missions to earn XP and level up</p>
            </div>

            <div className="flex gap-2">
                {tabs.map(t => (
                    <BasicTab key={t.value} label={t.label} isActive={tab === t.value} onClick={() => setTab(t.value)} />
                ))}
            </div>

            <div className="grid grid-cols-2 gap-4">
                {missions[tab].map((m, i) => (
                    <MissionCard key={i} mission={m} />
                ))}
            </div>
        </div>
    )
}