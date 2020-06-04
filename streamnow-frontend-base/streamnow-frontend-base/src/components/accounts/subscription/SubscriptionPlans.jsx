import React, { Component } from "react";
import Sidebar from "../../layouts/sidebar/Sidebar";
import api from "../../../Environment";
import { Link } from "react-router-dom";

class SubscriptionPlans extends Component {
  state = {
    subscriptionData: null,
    loadingSubscription: true,
  };
  componentDidMount() {
    this.getSubscriptionPlan();
  }
  getSubscriptionPlan = () => {
    api.postMethod("subscriptions_index").then((response) => {
      if (response.data.success) {
        this.setState({
          subscriptionData: response.data.data,
          loadingSubscription: false,
        });
      } else {
      }
    });
  };
  render() {
    const { loadingSubscription, subscriptionData } = this.state;
    return (
      <div className="main">
        <Sidebar />
        <div className="sec-padding subscriptions-price-plan left-spacing1">
          <div className="Spacer-10"></div>
          <div className="row">
            <div className="public-video-header">PRICING AND PLANS</div>
            <div className="col-xs-12 col-sm-12 col-md-12  col-lg-12">
              <div className="row  display-flex-row">
                {loadingSubscription ? (
                  "Loading..."
                ) : subscriptionData.length > 0 ? (
                  subscriptionData.map((subscription) => (
                    <div className="col-xs-12 col-sm-6 col-md-4 col-lg-4 top-margin display-flex-col">
                      <div className="box-shadow width-max">
                        <div
                          className="subscription-bg"
                          style={{
                            backgroundImage: `url(${subscription.picture});`,
                          }}
                        >
                          <div className="subscription-overlay">
                            <h3 className="sub-head">{subscription.title}</h3>
                            <h1 className="sub-head text-bold">
                              {subscription.subscription_amount_formatted}
                            </h1>
                          </div>
                        </div>
                        <div className="white-bg subscription-content">
                          <h4 className="sub-head">
                            Plan Type: {subscription.plan_text}
                          </h4>
                          <h4 className="sub-head padding-btm-sm">
                            {subscription.description}
                          </h4>
                          <div className="Spacer-5"></div>
                          <Link
                            to={{
                              pathname: "/subscription/invoice",
                              state: subscription,
                            }}
                          >
                            <button
                              className="btn2 width-120 btn-bottom-flex"
                              type="button"
                            >
                              PAY NOW
                            </button>
                          </Link>
                        </div>
                      </div>
                    </div>
                  ))
                ) : (
                  <div className="no-data-found-img">
                    <img src="../assets/img/no-data-found.png"></img>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default SubscriptionPlans;
