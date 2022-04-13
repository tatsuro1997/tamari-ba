import AboutItem from "./AboutItem";
import Button from "../Button";

import map from '../../../../../../public/images/map.webp';

const AboutList = (props) => {
    return (
        <section className="text-gray-600 body-font">
            <Button />
            <div className="container px-5 py-16 mx-auto">
                <div className="flex flex-col text-center w-full mb-20">
                    {props.abouts.map((about, index) => (
                        <AboutItem
                            key={about.id}
                            id={about.id}
                            title={about.title}
                            description={about.description}
                            image={index===0 && map}
                        />
                    ))}
                </div>
            </div>
        </section>
    );
};

export default AboutList;
