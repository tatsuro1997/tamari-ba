import PurposeItem from "./PurposeItem";

const PurposeList = (props) => {
    return (
        <section className="text-gray-600 body-font">
            <div className="container px-5 py-16 mx-auto">
                <div className="flex flex-col text-center w-full mb-20">
                    <div>
                        <h1 className="sm:text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">Tamari-Baの楽しみ方</h1>
                        <p className="lg:w-2/3 mx-auto leading-relaxed text-base">ソロでバイクを楽しみたい、複数人でツーリングに行きたい方やバイクをキッカケに活動の幅を広げていきたい方など、幅広い年代・目的でご利用いただけます。</p>
                    </div>
                </div>
                <div className="flex flex-wrap -m-4">
                    {props.purposes.map(purpose => (
                        <PurposeItem
                            key={purpose.id}
                            id={purpose.id}
                            image={purpose.image}
                            kind={purpose.kind}
                            title={purpose.title}
                            description={purpose.description}
                        />
                    ))}
                </div>
            </div>
        </section>
    );
};

export default PurposeList;
