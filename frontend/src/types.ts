export type Mission = {
  title: string;
  desc: string;
  xp: number;
  progress: number;
};

export type LeaderBoardRow = {
  rank: number;
  name: string;
  xp: string;
  change: number | null;
  isYou?: boolean;
};

export type AdminUserManagementTableRow = {
  id: number;
  name: string;
  email: string;
  active: boolean;
};

export type Rarity = "common" | "rare" | "legendary";
export type Achievement = {
  emoji: string;
  title: string;
  desc: string;
  rarity: Rarity;
  unlocked: boolean;
};

export type OverviewCardItem = {
  title: string;
  icon: React.ReactNode;
  primary: number | string;
  secondary: string;
  status: boolean;
  color: string;
};
