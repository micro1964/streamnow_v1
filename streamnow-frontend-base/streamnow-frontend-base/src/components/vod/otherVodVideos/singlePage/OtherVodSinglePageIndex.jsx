import React, { Component } from "react";
import OtherVodSinglePageVideo from "./OtherVodSinglePageVideo";
import OtherVodSinglePageRecentCard from "./OtherVodSinglePageRecentCard";
import Sidebar from "../../../layouts/sidebar/Sidebar";
import ToastContent from "../../../helper/ToastContent";
import { withToastManager } from "react-toast-notifications";
import api from "../../../../Environment";

class OtherVodSinglePageIndex extends Component {
  state = {
    loadingVideo: true,
    suggesstionData: null,
    loadingSuggesstion: true,
    skipCount: 0,
    loadMoreButtonDisable: false,
    loadingContent: null,
  };
  componentDidMount() {
    if (this.props.location.state == null) {
      ToastContent(this.props.toastManager, "Video not found", "error");
      this.props.history.push("/vod/video-list");
    }
    this.setState({ loadingVideo: false });
    const inputData = {
      skip: this.state.skipCount,
    };
    this.getVodSuggesstion(inputData);
  }

  loadMore = (event) => {
    event.preventDefault();
    this.setState({
      loadMoreButtonDisable: true,
      loadingContent: "Loading...",
    });
    const inputData = {
      skip: this.state.skipCount,
    };

    this.getVodSuggesstion(inputData);
  };

  getVodSuggesstion = (inputData) => {
    let items;
    api.postMethod("vod_videos_suggestions", inputData).then((response) => {
      if (response.data.success) {
        if (this.state.suggesstionData != null) {
          items = [...this.state.suggesstionData, ...response.data.data];
        } else {
          items = [...response.data.data];
        }
        this.setState({
          suggesstionData: items,
          loadingSuggesstion: false,
          skipCount: response.data.data.length + this.state.skipCount,
          loadMoreButtonDisable: false,
          loadingContent: null,
        });
      } else {
      }
    });
  };

  render() {
    if (this.state.loadingVideo) {
      return "Loading...";
    } else {
      const video = this.props.location.state;
      const {
        suggesstionData,
        loadingSuggesstion,
        loadMoreButtonDisable,
        loadingContent,
      } = this.state;
      return (
        <div className="main">
          <Sidebar />
          <div class="sec-padding livetv-view left-spacing1">
            <div class="Spacer-5"></div>
            <div class="public-video-header">Vod videos</div>
            <div class="Spacer-10"></div>
            <OtherVodSinglePageVideo video={video} />
            <div class="Spacer-20"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="public-video-header">Suggesstions</div>
              </div>
            </div>
            <div class="Spacer-20"></div>
            {loadingSuggesstion ? (
              "Loading..."
            ) : suggesstionData.length > 0 ? (
              <>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row small-padding">
                      {suggesstionData.map((video) => (
                        <OtherVodSinglePageRecentCard video={video} />
                      ))}
                    </div>
                  </div>
                </div>
                <div class="Spacer-10"></div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button
                      class="show-more-btn"
                      type="submit"
                      disabled={loadMoreButtonDisable}
                      onClick={this.loadMore}
                    >
                      {loadingContent != null ? loadingContent : "Show More"}
                    </button>
                  </div>
                </div>
              </>
            ) : (
              "No data found"
            )}
            <div class="Spacer-6"></div>
          </div>
        </div>
      );
    }
  }
}

export default withToastManager(OtherVodSinglePageIndex);
