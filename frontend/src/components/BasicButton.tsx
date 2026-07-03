export default function BasicButton({label}: { label: string }) {
    return <button className="bg-primary-normal text-white px-[30px] py-[18px]
    text-small font-bold rounded-full hover:bg-primary-hover cursor-pointer focus:bg-primary-focused">
        {label}
    </button>
}