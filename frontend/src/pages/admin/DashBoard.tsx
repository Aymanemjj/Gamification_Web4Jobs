import {FiUsers, FiStar, FiAward, FiZap} from "react-icons/fi";
import type { OverviewCardItem } from "../../types.ts";
import OverviewCard from "../../components/OverviewCard";
import { FetchUsers } from "../../services/useUserService.ts";
import Table from "../../components/Table.tsx";


const Overview: OverviewCardItem[] = [
    { title: "Total Learners", icon: <FiUsers />, primary: 2840, secondary: "12% this week", status: true, color: "text-blue-500" },
    { title: "XP Awarded", icon: <FiStar />, primary: "184K", secondary: "8% this week", status: true, color: "text-amber-500" },
    { title: "Badges Unlocked", icon: <FiAward />, primary: 9312, secondary: "341 today", status: true, color: "text-purple-500" },
    { title: "Active Streaks", icon: <FiZap />, primary: 638, secondary: "4% today", status: false, color: "text-rose-500" },
]


export default function Dashboard() {
  const { data, loading, error } = FetchUsers();

  return (
    <div>
      <div className="p-8 space-y-6">
        <div className="flex gap-4">
          {Overview.map((i, n) => (
            <OverviewCard item={i} key={n} />
          ))}
        </div>

        <div>
          {
            loading && <p>Loading...</p>
          }
          {
            error && <p>Error: {error}</p>
          }
          {
            data && <Table table={data} />
          }
        </div>
      </div>
    </div>
  );
}