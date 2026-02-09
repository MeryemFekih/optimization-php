why performance ? 
Performance is critical for any e-commerce website because slow-loading pages frustrate users, increase bounce rates, and directly reduce revenue. The /carousel page displays product content (galaxies and guitar models) with images, and currently visitors are scarce, suggesting the page is performing poorly

Identified Problems
1. Frontend Issues
    -Excessive or redundant Tailwind classes:
    Examples include:
    flex flex-row → flex-row is redundant since flex defaults to row direction.
    
    -Multiple alignment classes like justify-content, justify-items, text-center applied together. Most are redundant and can be simplified.

    -Unnecessary spacing classes:
    Classes like space-y-12, w-11/12, space-y-6 often do not impact the layout and can be removed to reduce HTML clutter.
    - we need to Specialize image dimensions:
    define height and width for each image to prevent layout shifts and improve page load speed, beceause browser can allocate space before the image loads.

    -Incorrect choice of semantic elements:
    Example: Using <main><section><div> where a single <section> would suffice improves readability and accessibility.

2. Backend Issues
    2.1 CarouselController

        -Inefficient database queries:
        The current algorithm loops through Galaxy entities and then queries Modeles, ModelesFiles, and DirectusFiles for each galaxy.
        This results in multiple nested database queries = slowing down page load.

        so we need to minimize queries by using JOINs to fetch all necessary data in a single query.
        Implement pagination to limit the number of results per request.
        Use caching with expiration rules so the page can be pre-generated and quickly served, reducing load times.

    2.2 Entity Design
        -Incorrect data types:
        Many entity fields are defined as string by default. Some fields should use more appropriate type
        -Excessive field lengths:
        Many string fields are set to length=225+, which is unnecessary.
        -Lack of ORM relationships:
        Proper entity relationships are not defined, resulting in inefficient queries and data redundancy.

how we found these problems ? we use : 
        - Page load time using Chrome DevTools
        - Largest Contentful Paint (LCP)
        - Symfony Web Debug Toolbar helps also 

Proposed Future Modifications
    -Introduce caching mechanisms with expiration to speed up repeated requests.
    -Implement image compression to reduce file size and improve load times.
    -Consider using a Content Delivery Network (CDN) or distributed server system to serve content faster to users in different regions.