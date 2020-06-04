import React, { Component } from "react";

class RedeemPayments extends Component {
  state = {};
  render() {
    const {
      payments,
      cancelInputData,
      cancelRedeem,
      cancelLoadingContent,
      cancelButtonDisable,
    } = this.props;
    return (
      <div className="timeline-item">
        <div className="timeline-bar">
          <div className="version"></div>
        </div>
        <div className="redeem-content">
          <ul>
            <li>
              <p className="text-grey-clr m-0">
                Sent date: {payments.created_at}
              </p>
              <h4 className="redeem-amount">
                Paid amount:{" "}
                <span className="bold">{payments.paid_amount_formatted}</span>
              </h4>
              <p className="text-grey-clr mt-0">
                Requested Amount: {payments.request_amount_formatted}
              </p>

              <p className="text-grey-clr mt-0">
                Status: {payments.redeem_status}
              </p>
            </li>
            <li>
              {payments.cancel_btn_status == 1 ? (
                <div className="mt-10 mb-15 text-right">
                  <a
                    className="btn2"
                    style={{ cursor: "pointer" }}
                    disabled={
                      cancelInputData.redeem_request_id ==
                        payments.redeem_request_id && cancelButtonDisable
                        ? true
                        : false
                    }
                    onClick={(event) => cancelRedeem(event, payments)}
                  >
                    {cancelInputData.redeem_request_id ==
                      payments.redeem_request_id && cancelLoadingContent != null
                      ? cancelLoadingContent
                      : "Cancel"}
                  </a>
                </div>
              ) : (
                ""
              )}
            </li>
          </ul>
        </div>
      </div>
    );
  }
}

export default RedeemPayments;
