Tolkien
=========
Tolkien is a simple static web generator (especially for blog) mainly inspired by Jekyll. Tolkien is purely written in PHP and can be used as a composer package.

Requirement
-----------
* Minimum PHP >= 5.3.*
* Very Recommended to use PHP >= 5.4 because Tolkien relies on PHP built-in webserver to run your static web page directly via Tolkien 'serve' command

Installation
------------
The best way to install Tolkien is to use Composer to install it. Add this following requirement section below to your composer.json file 

    {
        "require": {
            "tolkien/tolkien": "dev-master"
        }
    }
    
and then run
    
    php composer.phar install
    
Basic Usage
-----------
Once Tolkien installed in our project directory as a composer package, we can directly run some commands to use it. For help & command informations, run

    vendor\bin\tolkien

#### Initialization
The first thing we must do is create our blog. For example, if we want to create a blog named **myblog**, then we use this command below

    vendor\bin\tolkien init myblog

It will create some essential folders inside **myblog** in our project directory, such as

    _assets    // put our website assets like css, js or image files here
    _layouts   // layout for post/page will be placed here
    _drafts    // post or page draft
    _posts     // our post article is placed here  
    _pages     // our page is placed here
    _sites     // our static website will be placed here
    config.yml // main config file
    
We can add some informations about our web inside config.yml file. Look at this config.yml example below. This config below is generated after we run the initialization command

    config:
        name: myblog
        url: /
        title: Your Blog Title
        tagline: Your Blog Tagline
        pagination: 10
    dir:
        post: myblog/_posts
        page: myblog/_pages
        draft: myblog/_drafts
        site: myblog/_sites
        asset: myblog/_assets
        layout: myblog/_layouts
    authors:
        tolkien:
            name: 'John Ronald Reuel Tolkien'
            email: tolkien@kodetalk.com
            facebook: Tolkien
            twitter: '@tolkien'
            github: Tolkien
            signature: 'Creator of LoTR Trilogy'

config.yml uses YAML configuration format. For now, make sure we just only change title and tagline in config section, and authors section. Maybe you want to change author's content with your bio or add your co-author. My own will look like

    // other config section
    authors:
        glend:
            name: 'Glend Maatita'
            email: glend@kodetalk.com
            facebook: Glend Maatita
            twitter: '@glend_maatita'
            github: glendmaatita
            signature: 'Just another author'
        benny:
            name: 'Benny Maatita'
            email: benny@kodetalk.com
            facebook: Benny Maatita
            twitter: '@benny_maatita'
            github: bennymaatita
            signature: 'Just another author like Glend'    

#### Generate Post
If we want to write an article for our **myblog**, then we create a post. For example, to create a post titled ***Introduction to PHP***, using layout ***post***, authored with ***glend*** we run this command

    vendor\bin\tolkien generate:post --author=glend --layout=post myblog "Introduction to PHP"
    
It will create a file with format : *date-title.markdown* inside **_posts** folder. The generated file's content has 2 section : header and body. Header is content with YAML format beetwen --- . Look at this generated file's content

    ---
    type: post
    layout: post
    title: Introduction to PHP
    date: 2013-09-20
    author: glend
    categories: category1
    ---

*type: post* indicates that the file is a post file. *layout: post* means that we use post layout inside **_layouts** folder. *title* is your Post's title, you can change the title if you want. 

Author is an alias of author taken from the config file (author section). And categories section will define your post's categories. You can add more than one category here, separated with comma (','). That's a header.

For body section, you can add the body below the header. We can use Markdown which is highly recommended for body format. But you can also use HTML format. To use HTML format for the post body, you **must** change the post file extension to **.html**. So based on generated example file above, you must change its name to *date-title.html*.

For another options and information run : 

    vendor\bin\tolkien generate:post -h

#### Generate Page
Page is just like Post, but without author, categories, and date section on its header. if we want to create a page for our **myblog** web, for example Contact page with ***page*** layout, we simply run this command below

    vendor\bin\tolkien generate:page --layout=page myblog "Contact Us"
    
The command above will create a file with format title.markdown inside **_pages** folder. Its content is same with Post, has two section (header and body) and you can add the body below the header. The body format is Markdown, but you can use HTML format with the same rule as Post. 

For another options and information to generate page, run : 

    vendor\bin\tolkien generate:page -h

#### Compile 
Compile is Tolkien's command for generate our static web page based on posts and pages file that we created before. The generated web page will be placed under **_sites** folder. Look at this compile command below

    vendor\bin\tolkien compile blog
    
Check on *_sites* folder and we will find our assets (css, js, images) files, page file, and post file become a static web page 

#### Serve
Serve command relies on PHP Built-in webserver to run our static web page directly. Just type this command below and we can access our beloved **myblog** page  with url : **localhost:3000**

    vendor\bin\tolkien serve myblog

## Layout
To create layout files under **_layout**, Tolkien use  [Twig](http://twig.sensiolabs.org/) template engine which is awesome. In other words, you can use all Twig's features including Filters, Functions, Control Structure, Expression, etc.

The default layout is available under **_layout**, but you are totally free to create your own layout. Just use Twig template engine, and some variables below.

## Variable
Tolkien has several variables that you can pass to your layout files (Twig template) inside **_layouts**, such as

#### Site Variables

    site.url            // URL of your web. Defined at config.yml
    site.title          // Title of your web. Defined at config.yml
    site.tagline        // Tagline. Defined at config.yml
    site.posts          // Get all posts
    site.pages          // Get all pages
    site.categories     // Get all posts's categories
    
#### Category Variables

    category.url    // URL for category page. This page may contains a list of post of certain category
    category.name   // Category's name
    category.posts  // get all category's posts. A list of post with certain category

#### Post Variables

    post.title      // Get Post's title
    post.body       // Body
    post.url        // Post's URL
    post.layout     // Layout
    post.excerpt    // Get post's excerpt
    post.categories // Get post's categories
    post.publishDate    // Publish date
    
#### Post's Author
    
    post.author.name        // Name of Post's Author
    post.author.email       // Author's email
    post.author.signature   // Signature
    post.author.facebook
    post.author.twitter
    post.author.github
    
#### Page Variables

    page.title      // Page's Title
    page.body       // Body
    page.url        // Page's URL
    
### Pagination Variables

    pagination.posts    // Get all post in a particular pagination
    pagination.previousPage // Get previous page in pagination
    pagination.nextPage // Get next page
    pagination.numberPage   // get current number of this pagination
    pagination.url      // Pagination's URL
    
## Index HTML

Index or Home is the first page that always will be opened when a visitor come to your website. Index is just an ordinary Page with special layout. To create index, just run **generate page** command like below

    vendor\bin\tolkien generate:page --layout=index myblog index
    
then, change the layout to index

    ---
    type: page
    layout: index
    title: Home
    ---
    
## Pagination
Pagination is included by default in Tolkien. See the config.yml file and you'll find Tolkien had set a number of post (10 by default) in a pagination for you. You can change this number. ***Remember***, dont delete this pagination section, use if you want to use pagination or ignore if you dont want to use.

Normally, we use this feature on index page. So, lets change your index page to be like below, for example

    {% for post in pagination.posts %}
    // code for display a list of post in a particular pagination
    {% endfor %}
    {% if pagination.previousPage is not null %}
    <div>
        <a href="{{ pagination.previousPage.url }}">Previous</a>
    </div>
    {% endif %}
    {% if pagination.nextPage is not null %}
    <div>
        <a href="{{ pagination.nextPage.url }}">Next</a>
    </div>
    {% endif %}
    
## Deployment
Check [Heston](http://github.com/glendmaatita/heston/) on Github for easy deployment using FTP. If you use Heston, just run this command below to deploy your site that generated with Tolkien to your FTP Server

    vendor\bin\heston ftp://username:password@ftp.domain.tld:port myblog/_sites/ "_your_comment_"
    
## Other
For documentation in Bahasa (Indonesian) Version, please refer to [Kodetalk](http://www.kodetalk.com/tolkien.html). Kodetalk's source code using Tolkien on [Github](http://github.com/KodeTalk/website)

License
----
Tolkien is released under the MIT License. Check License file for detail
