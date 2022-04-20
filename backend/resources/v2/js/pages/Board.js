const Board = () => {
    return (
        <div className="text-center">
            <h2 className='text-xl font-bold text-gray-700 mb-4'>🏍 Slackバイカーコミュニティでツーリングに行こう 🏍</h2>
            <a
                target="_blank"
                href="https://join.slack.com/t/tamari-ba/shared_invite/zt-17jwqriww-R8Bhs4YxDhBwcVeHWs1gfg"
            >
                <button className="flex font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full text-lg">
                    無料バイカーコミュニティに参加する
                </button>
            </a>
        </div>
    );
};

export default Board;
