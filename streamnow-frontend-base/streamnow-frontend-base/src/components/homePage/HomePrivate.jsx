import React, { Component } from "react";
import HomePrivateCard from "./HomePrivateCard";

class HomePrivate extends Component {
  state = {};
  render() {
    const {
      loadingContent,
      loadMoreButtonDisable,
      liveVideoPrivateData,
      loadingLiveVideoPrivate,
    } = this.props;
    return (
      <div role="tabpanel" className="tab-pane" id="private">
        <div className="row">
          {loadingLiveVideoPrivate ? (
            "Loading..."
          ) : liveVideoPrivateData.length > 0 ? (
            liveVideoPrivateData.map((video) => (
              <>
                <HomePrivateCard video={video} />
              </>
            ))
          ) : (
            <div className="no-data-found-img">
              <div className="Spacer-10"></div>
              <img src="../assets/img/no-data-found.png"></img>
            </div>
          )}
        </div>
      </div>
    );
  }
}

export default HomePrivate;
