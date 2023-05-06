# 1. Introduction
This task is used as a skill assessment assignment which Q uses in it’s selection process to determine the best candidate for the job. All test assignments should be solvable within a
maximum of 8 hours by an experienced developer. These assignments are not a part of any
client project and are not a part (and will not be) of any production project. Q however reserves
the right to limit the disclosure of the assignment contents. This assignment is aimed at all
developers' seniority and experience levels.

# 2. Assignment
## General tips and trick:
- Create a new Wordpress PHP project, push it to Github/Bitbucket/Gitlab repository
and when the assignment is done send us a link or an invite to the repository
- feel free to ignore the frontend part - don't spend your time on CSS and styling,
functionality is the most important part. Naked HTML is fine too! :-)
- setup of the project must be as simple as possible - document the setup process (the
simpler the better)
- if you have further questions or are unsure about something - send us an email, and
we’ll either answer your questions or give you a hint/nudge in the right direction
- minimal validation is enough, don't waste too much time on it - if the request passes,
it's ok!

## Client
- create a client for connection on Q Symfony Skeleton API (QSS)
    - swagger documentation: https://symfony-skeleton.q-tests.com/docs
- credentials:
    - email: ahsoka.tano@q.agency
    - password: Kryze4President

- create a login page that uses Q Symfony Skeleton API, retrieve access token
- store the token using any storage you want (Session, Cookie, something more
creative? (Up to you!), with any expiration time (use common sense, 10 seconds is a
bad expiration time! :))

## Wordpress
- Create plugin Movies
    - Inside plugin add logic for:
        - Create custom post type Movies that will be display in admin menu and can be used in REST API
        - Create post meta field movie_title
        - Create meta box / or Gutenberg panel in which user will be able to enter value for movie_title post meta
            - Any display solution is ok (meta box or using Gutenberg panel / wordpress component)
-  Inside theme
    - Create custom template for movies post type
        - Display content in one HTML section / element and movie_title in other HTML section / element

* Advanced:
- Create gutenberg block Favorite movie quote with one text field using wordpress
components which will be saved in block attribute
- Block should be set as dynamic block (output should be handled from callback
function / server side)
