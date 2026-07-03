import {type OverviewCardItem} from "../types.ts"
import { FiTrendingDown, FiTrendingUp } from "react-icons/fi";

export default function OverviewCard({ item }: { item: OverviewCardItem }) {
    return (
        <div className="border border-border dark:bg-bg-dark-hover dark:border-bg-dark-hover rounded-2xl p-5 flex items-center gap-4 w-full">
            <div className="bg-gray-100 dark:bg-bg-dark-hover rounded-xl p-2">
                <span className={`text-xl ${item.color}`}>{item.icon}</span>
            </div>
            <div>
                <p className="text-2xl font-semibold dark:text-white">{item.primary}</p>
                <p className="text-muted text-small">{item.title}</p>
                <p className={`text-xs mt-0.5 ${item.status ? "text-green-500" : "text-red-500"}`}>
                    {item.status ? <FiTrendingUp /> : <FiTrendingDown />} {item.secondary}
                </p>
            </div>
        </div>
    )
}