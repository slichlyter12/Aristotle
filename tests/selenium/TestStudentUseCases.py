import json
import unittest
import HTMLTestRunner
import time
from selenium import webdriver

class Test_Student_Use_Cases(unittest.TestCase):
    @classmethod
    def setUpClass(self):
        self.driver = webdriver.Chrome()
        # self.driver.implicitly_wait(5)
 
    def test_login_error(self):
        driver = self.driver
        driver.get("http://web.engr.oregonstate.edu/~lite/CS561-Project/pages/")
        self.assertIn("Aristotle", driver.title)
        login_home_btn = driver.find_element_by_class_name("btn")
        self.assertIsNotNone(login_home_btn)
        login_home_btn.click()

        # time.sleep(1)
        username_element = driver.find_element_by_id("username")
        self.assertIsNotNone(username_element)
        username_element.send_keys('test_username')

        password_element = driver.find_element_by_id("password")
        self.assertIsNotNone(password_element)
        password_element.send_keys('test_password')

        login_btn = driver.find_element_by_name("_eventId_proceed")
        self.assertIsNotNone(login_btn)
        login_btn.click()

        self.assertIn("login.oregonstate.edu", driver.current_url)

    def test_login(self):
        driver = self.driver

        # user_pass.json format
        # {
        #   "username":"xxx",
        #   "password":"xxx"
        # }
        f = open('user_pass.json', 'r')
        userData = f.read()
        f.close()
        user = json.loads(userData)

        time.sleep(1)
        username_element = driver.find_element_by_id("username")
        self.assertIsNotNone(username_element)
        username_element.clear()
        username_element.send_keys(user['username'])

        password_element = driver.find_element_by_id("password")
        self.assertIsNotNone(password_element)
        password_element.clear()
        password_element.send_keys(user['password'])

        login_btn = driver.find_element_by_name("_eventId_proceed")
        self.assertIsNotNone(login_btn)
        login_btn.click()

        time.sleep(1)
        # if user is ta, redirect to studentDashboard.php
        if "pages/ta.php" in driver.current_url:
            link_to_student = driver.find_element_by_id("toStudent")
            self.assertIsNotNone(link_to_student)
            link_to_student.click()

        # time.sleep(1) 
        self.assertIn("pages/studentDashboard.php", driver.current_url)

    def test_manage_class(self):
        driver = self.driver

        # read selected classes
        classes_list_elements = driver.find_element_by_xpath(".//*[@class='classList']")
        self.assertIsNotNone(classes_list_elements)
        selected_classes_elements = classes_list_elements.find_elements_by_xpath(".//*[@class='classes selectedClass']")
        selected_class_name = []
        for x in selected_classes_elements:
            selected_class_name.append(x.get_attribute('name'))

        # add & remove classes
        manage_class_btn = driver.find_element_by_class_name("openAddClassFormDialog")
        self.assertIsNotNone(manage_class_btn)
        manage_class_btn.click()

        time.sleep(1)   
        span_elements = driver.find_elements_by_xpath(".//*[@class='classCheckBox']")
        self.assertIsNotNone(span_elements)
        click_select_class_name = ''
        click_unselect_class_name = ''
        for x in span_elements:
            if click_select_class_name != '' and click_unselect_class_name != '':
                break
            class_element = x.find_element_by_xpath(".//*[@type='checkbox']")
            self.assertIsNotNone(class_element)
            val = class_element.get_attribute('value')
            # if class_element.get_attribute('checked') == 'true':
            if len(selected_class_name) == 0:
                x.click()
                click_select_class_name = val
                break

            if val == selected_class_name[0] and click_unselect_class_name == '':
                click_unselect_class_name = val
                x.click()
            elif click_select_class_name == '' and val not in selected_class_name:
                click_select_class_name = val
                x.click()

        # submit 
        add_classes_btn = driver.find_element_by_xpath(".//*[@class='submitBtn button-primary']")
        self.assertIsNotNone(add_classes_btn)
        add_classes_btn.click()

        # read new selected classes
        time.sleep(1)
        new_classes_list_elements = driver.find_element_by_xpath(".//*[@class='classList']")
        self.assertIsNotNone(new_classes_list_elements)
        new_selected_classes_elements = new_classes_list_elements.find_elements_by_xpath(".//*[@class='classes selectedClass']")
        new_selected_class_name = []
        for x in new_selected_classes_elements:
            new_selected_class_name.append(x.get_attribute('name'))

        if click_select_class_name != '':
            self.assertIn(click_select_class_name, new_selected_class_name)
        if click_unselect_class_name != '':
            self.assertNotIn(click_unselect_class_name, new_selected_class_name)

        # tear down
        # add & remove classes
        manage_class_btn.click()
        time.sleep(1)   
        span_elements = driver.find_elements_by_xpath(".//*[@class='classCheckBox']")
        self.assertIsNotNone(span_elements)
        for x in span_elements:
            if click_select_class_name == '' and click_unselect_class_name == '':
                break
            class_element = x.find_element_by_xpath(".//*[@type='checkbox']")
            val = class_element.get_attribute('value')
            if val == click_select_class_name:
                click_select_class_name = ''
                x.click()
            elif val == click_unselect_class_name:
                click_unselect_class_name = ''
                x.click()
        # submit 
        add_classes_btn.click()

        # read new selected classes
        time.sleep(1)
        new_classes_list_elements = driver.find_element_by_xpath(".//*[@class='classList']")
        self.assertIsNotNone(new_classes_list_elements)
        new_selected_classes_elements = new_classes_list_elements.find_elements_by_xpath(".//*[@class='classes selectedClass']")
        new_selected_class_name = []
        for x in new_selected_classes_elements:
            new_selected_class_name.append(x.get_attribute('name'))

        self.assertEqual(new_selected_class_name, selected_class_name)

    def test_questoin_list(self):
        driver = self.driver

        classes_list_elements = driver.find_element_by_xpath(".//*[@class='classList']")
        self.assertIsNotNone(classes_list_elements)
        selected_classes_elements = classes_list_elements.find_elements_by_xpath(".//*[@class='classes selectedClass']")

        click_select_class_name = ''
        if len(selected_classes_elements) > 0:
            selected_classes_elements[0].click()
        else:
            # add & remove classes
            manage_class_btn = driver.find_element_by_class_name("openAddClassFormDialog")
            self.assertIsNotNone(manage_class_btn)
            manage_class_btn.click()

            time.sleep(1)
            span_elements = driver.find_elements_by_xpath(".//*[@class='classCheckBox']")
            self.assertIsNotNone(span_elements)
            
            if len(span_elements) > 0:
                class_element = span_elements[0].find_element_by_xpath(".//*[@type='checkbox']")
                self.assertIsNotNone(class_element)
                click_select_class_name = class_element.get_attribute('value')
                span_elements[0].click()

            # submit 
            add_classes_btn = driver.find_element_by_xpath(".//*[@class='submitBtn button-primary']")
            self.assertIsNotNone(add_classes_btn)
            add_classes_btn.click()

            classes_list_elements = driver.find_element_by_xpath(".//*[@class='classList']")
            self.assertIsNotNone(classes_list_elements)
            
            selected_classes_elements = classes_list_elements.find_elements_by_xpath(".//*[@class='classes selectedClass']")
            self.assertIsNotNone(selected_classes_elements)
            if len(selected_classes_elements) > 0:
                selected_classes_elements[0].click()

        # question list test
        self.assertIn("pages/studentQuestions.php", driver.current_url)
        
        # ... ...

        #tear down
        time.sleep(1)

        if click_select_class_name != '':
            back_btn = driver.find_element_by_class_name("back")
            self.assertIsNotNone(back_btn)
            back_btn.click()
            self.assertIn("pages/studentDashboard.php", driver.current_url)
            
            # add & remove classes
            manage_class_btn = driver.find_element_by_class_name("openAddClassFormDialog")
            self.assertIsNotNone(manage_class_btn)
            manage_class_btn.click()

            time.sleep(1)
            span_elements = driver.find_elements_by_xpath(".//*[@class='classCheckBox']")
            self.assertIsNotNone(span_elements)
            
            for x in span_elements:
                class_element = span_elements[0].find_element_by_xpath(".//*[@type='checkbox']")
                self.assertIsNotNone(class_element)
                if click_select_class_name == class_element.get_attribute('value'):
                    span_elements[0].click()
                    break

            # submit 
            add_classes_btn = driver.find_element_by_xpath(".//*[@class='submitBtn button-primary']")
            self.assertIsNotNone(add_classes_btn)
            add_classes_btn.click()

            time.sleep(1)
        

    @classmethod
    def tearDownClass(self):
        self.driver.quit()

def Suite():
    suiteTest = unittest.TestSuite()  
    suiteTest.addTest(Test_Student_Use_Cases("test_login_error"))  
    suiteTest.addTest(Test_Student_Use_Cases("test_login"))  
    suiteTest.addTest(Test_Student_Use_Cases("test_manage_class")) 
    suiteTest.addTest(Test_Student_Use_Cases("test_questoin_list")) 
    return suiteTest

if __name__ == "__main__":
    # unittest.main()
    now = time.strftime("%Y%m%d_%H%M%S",time.localtime(time.time()))
    report_path = ".\\report\\report_student_" + now + ".html"
    fp = open(report_path, 'wb')   
    runner = HTMLTestRunner.HTMLTestRunner(stream=fp, title='Student Use Cases TestReport', description='Test Student Use Cases')  
    runner.run(Suite())
    fp.close()
