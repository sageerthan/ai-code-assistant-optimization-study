import json
import os

def main():
    # open all json files in the directory
    directory = os.path.join("..", "output", "leetcode", "amazon_q")
    files = [os.path.join(directory, f) for f in os.listdir(directory) if os.path.isfile(os.path.join(directory, f))]

    # get all the submissions
    submissions = []
    for f in files:
        with open(f) as json_file:
            data = json.load(json_file)
            submissions_list = data['submissions_dump']
            for submission in submissions_list:
                submissions.append(submission)

    # get all submission with the same lang and title
    python_submissions = {}
    java_submissions = {}
    javascript_submissions = {}
    php_submissions = {}
    for submission in submissions:
        if submission['lang'] == 'python' and submission['title'] not in python_submissions:
            python_submissions[submission['title']] = submission
        elif submission['lang'] == 'java' and submission['title'] not in java_submissions: 
            java_submissions[submission['title']] = submission
        elif submission['lang'] == 'javascript' and submission['title'] not in javascript_submissions:
            javascript_submissions[submission['title']] = submission
        elif submission['lang'] == 'php' and submission['title'] not in php_submissions:
            php_submissions[submission['title']] = submission

    # helper function to group by status_display
    def group_by_status(submissions_dict):
        grouped = {}
        for submission in submissions_dict.values():
            status = submission["status_display"]
            slug = submission["title_slug"]
            if status not in grouped:
                grouped[status] = []
            grouped[status].append(slug)
        return grouped

    python_status_display = group_by_status(python_submissions)
    java_status_display = group_by_status(java_submissions)
    javascript_status_display = group_by_status(javascript_submissions)
    php_status_display = group_by_status(php_submissions)

    # pretty print function
    def print_stats(lang_name, status_dict):
        print(lang_name + ":")
        for status, slugs in status_dict.items():
            print(f"{status}: {len(slugs)}")
            if status != "Accepted":  # list slugs only for non-accepted statuses
                for slug in slugs:
                    print(f"   - {slug}")
        print("=========")

    print("AmazonQ STATS")
    print_stats("Python", python_status_display)
    print_stats("Java", java_status_display)
    print_stats("Javascript", javascript_status_display)
    print_stats("Php", php_status_display)

     # save results to JSON file
    results = {
        "Python": {status: {"count": len(slugs), "slugs": slugs} for status, slugs in python_status_display.items()},
        "Java": {status: {"count": len(slugs), "slugs": slugs} for status, slugs in java_status_display.items()},
        "Javascript": {status: {"count": len(slugs), "slugs": slugs} for status, slugs in javascript_status_display.items()},
        "Php": {status: {"count": len(slugs), "slugs": slugs} for status, slugs in php_status_display.items()},
    }

    with open("amazonq_stat_analysis_results.json", "w", encoding="utf-8") as outfile:
        json.dump(results, outfile, indent=4)

    print("✅ Results saved to amazonq_stat_analysis_results.json")


main()
