<div class="product-tab">
    <!-- Tab Navigation -->
    <div class="tab-nav">
        <ul>
            <li class="active">
                <a data-toggle="tab" href="#description">
                    <span>Description</span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#additional-information">
                    <span>Additional Information</span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#review">
                    <span>Review</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Description -->
        <div role="tabpanel" class="tab-pane fade in active" id="description">
            @include('catalog.product.partial.description')
        </div>

        <!-- Product Tag -->
        <div role="tabpanel" class="tab-pane fade" id="additional-information">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
        </div>

        <!-- Review -->
        <div role="tabpanel" class="tab-pane fade" id="review">
            <div class="reviews">
                <div class="comments-list">
                    <div class="item d-flex">
                        <div class="comment-left">
                            <div class="avatar">
                                <img src="img/avatar.jpg" alt="" width="70" height="70">
                            </div>
                            <div class="product-rating">
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star on"></div>
                            </div>
                        </div>
                        <div class="comment-body">
                            <div class="comment-meta">
                                <span class="author">Peter</span> - <span class="time">June 02, 2018</span>
                            </div>
                            <div class="comment-content">Look at the sunset, life is amazing, life is beautiful, life is what you make it. To succeed you must believe. When you believe, you will succeed. In life there will be road blocks but we will over come it. Celebrate success right, the only way, apple. The ladies always say Khaled you smell good, I use no cologne. Cocoa butter is the key. </div>
                        </div>
                    </div>

                    <div class="item d-flex">
                        <div class="comment-left">
                            <div class="avatar">
                                <img src="img/avatar.jpg" alt="" width="70" height="70">
                            </div>
                            <div class="product-rating">
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star on"></div>
                                <div class="star"></div>
                            </div>
                        </div>
                        <div class="comment-body">
                            <div class="comment-meta">
                                <span class="author">Merry</span> - <span class="time">June 17, 2018</span>
                            </div>
                            <div class="comment-content">Look at the sunset, life is amazing, life is beautiful, life is what you make it. To succeed you must believe. When you believe, you will succeed. In life there will be road blocks but we will over come it. Celebrate success right, the only way, apple. The ladies always say Khaled you smell good, I use no cologne. Cocoa butter is the key. </div>
                        </div>
                    </div>
                </div>

                <div class="review-form">
                    <h4 class="title">Write a review</h4>

                    <form action="index.html" method="post" class="form-validate">
                        <div class="form-group">
                            <div class="text">Your Rating</div>
                            <div class="product-rating">
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text">You review<sup class="required">*</sup></div>
                            <textarea id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Send your review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








