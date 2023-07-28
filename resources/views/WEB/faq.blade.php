@extends('WEB.partials.app')
@section('title',('Welcome To ORDERPOZ'))

@section('content')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        <img src="{{asset('front-end/assets')}}/images/inner-bg.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
        <div class="breadcrumb-content">
            <div>
                <h2>FAQ</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="title-breadcrumb">ORDERPOZ</div>
    </section>
    <!-- breadcrumb end -->


    <!-- section start-->
    <section class="small-section bg-inner" data-sticky_parent>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="pro_sticky_info" data-sticky_column>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                        href="#general">general</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#about">about</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#pricing">pricing</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#booking">booking</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#payment">payment</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                        href="#cancellation">cancellation & refunds</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#visa">visa &
                                        insurance</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#forex">Foreign
                                        Exchange (FOREX)</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#hotels">hotels</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#account">my
                                        account</a></li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#support">support</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#contact">contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="single-section mt-3 d-none d-lg-block">
                            <div class="single-sidebar p-0">
                                <div class="newsletter-sec">
                                    <div>
                                        <h4 class="title">always first</h4>
                                        <p>Be the first to find out latest deals and exclusive offers and get 15% off
                                            your first order.</p>
                                        <form>
                                            <input type="email" id="email1" class="form-control"
                                                placeholder="Enter your email">
                                            <div class="button">
                                                <a href="#" class="btn btn-solid ">be the first</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="product_img_scroll" data-sticky_column>
                        <div class="faq-content tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="general">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="about">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pricing">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="booking">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cancellation">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="visa">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="forex">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="hotels">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="support">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                The standard Lorem Ipsum passage, used since the 1500s
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                            ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                            dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                1914 translation by H. Rackham
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            But I must explain to you how all this mistaken idea of denouncing pleasure
                                            and praising pain was born and I will give you a complete account of the
                                            system, and expound the actual teachings of the great explorer of the truth,
                                            the master-builder of human happiness. No one rejects, dislikes, or avoids
                                            pleasure itself, because it is pleasure, but because those who do not know
                                            how to pursue pleasure rationally encounter consequences that are extremely
                                            painful. Nor again is there anyone who loves or pursues or desires to obtain
                                            pain of itself, because it is pain, but because occasionally circumstances
                                            occur in which toil and pain can procure him some great pleasure.
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in
                                                45 BC
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                            molestias excepturi sint occaecati cupiditate non provident, similique sunt
                                            in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                            fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                            tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus
                                            id quod maxime placeat facere possimus,
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section end-->
    @endsection