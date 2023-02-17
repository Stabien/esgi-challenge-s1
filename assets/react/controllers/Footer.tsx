import React from "react";
import "./../../styles/app.scss";

type Props = {};

const Footer = (props: Props) => {
  return (
    <div className="footer">
      <div className="hero-container">
        <div className="losange"></div>
        <img
          className="hero"
          src="./assets/images/assassin.png"
          alt="no image"
        />
      </div>
      <div className="image-container">
        <img
          className="landscape"
          src="./assets/images/vallee.png"
          alt="no image"
        />
        <img
          className="landscape"
          src="./assets/images/sol.png"
          alt="no image"
        />
      </div>
    </div>
  );
};

export default Footer;
