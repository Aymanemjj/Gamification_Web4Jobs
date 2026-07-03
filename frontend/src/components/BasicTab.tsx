export default function BasicTab({ label, isActive, onClick }: { label: string, isActive: boolean, onClick: () => void }) {
    return (
        <button
            onClick={onClick}
            className={isActive
                ? "block bg-primary-normal hover:bg-primary-hover text-white px-[30px] text-left py-[18px] text-small font-bold rounded-full cursor-pointer"
                : "block dark:hover:bg-bg-dark-hover hover:bg-bg-light-hover text-left text-muted px-[30px] py-[18px] text-small font-bold rounded-full cursor-pointer"
            }
        >
            {label}
        </button>
    )
}