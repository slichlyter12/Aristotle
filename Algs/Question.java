package algs;


import java.text.DateFormat;
import java.util.Date;

public class Question {
	
	private int questionID;
	private String questionName;
	private int interestsCnt;
	private Date createdTime;
	private Date currentTime;
	private float interestIndex;
	
	public Question(int id, String name, int interests, Date created)
	{
		questionID = id;
		questionName = name;
		interestsCnt = interests;
		createdTime = created;
		currentTime = new Date();
		interestIndex = (float)interestsCnt * 1000*3600 / (float)(currentTime.getTime() - createdTime.getTime());
	}
	
	public Question(Question oldQuestion)
	{
		questionID = oldQuestion.questionID;
		questionName = oldQuestion.questionName;
		interestsCnt = oldQuestion.interestsCnt;
		createdTime = oldQuestion.createdTime;
		currentTime = oldQuestion.currentTime;
		interestIndex = oldQuestion.interestIndex;
	}
	
	
	public static Question[] sortQuestions(Question[] questionsToSort)
	{
		Question sortedQuestions[] = new Question[questionsToSort.length];
		for(int i = 0;i < questionsToSort.length;i++)
		{
			sortedQuestions[i] = new Question(questionsToSort[i]);
		}
		quickSort(sortedQuestions,0,sortedQuestions.length - 1);
		return sortedQuestions;
	}
	

	
	public float getInterestIndex()
	{
		return interestIndex;
	}
	
    private static void quickSort(Question[] arr, int low, int high) 
    {  
        if (arr == null || arr.length == 0) 
        {
            return; 
        }
        if (low >= high) 
        {
            return; 
        }
        // pick the pivot  
        int middle = low + (high - low) / 2;  
        float pivot = arr[middle].getInterestIndex();  
        // make left < pivot and right > pivot  
        int i = low, j = high;  
        while (i <= j) 
        {  
            while (arr[i].getInterestIndex() > pivot) 
            {  
                i++;  
            }
            while (arr[j].getInterestIndex() < pivot) 
            {  
                j--;  
            }  
            if (i <= j) 
            {  
                Question temp = arr[i];  
                arr[i] = arr[j];  
                arr[j] = temp;  
                i++;  
                j--;  
            }  
        }  
        // recursively sort two sub parts  
        if (low < j) 
        {
            quickSort(arr, low, j);  
        }
        if (high > i)  
        {
            quickSort(arr, i, high);  
        }
    }  
    

	public String toString()
	{
		String s = "";
		s = s + "ID: " + Integer.toString(questionID) + "\n";
		s = s + "Name: " + questionName + "\n";
		s = s + "Number of interests： " + Integer.toString(interestsCnt) + "\n";
		s = s + "Time created: " + createdTime.toGMTString() + "\n";
		s = s + "Exsiting for: " + String.valueOf(currentTime.getTime() - createdTime.getTime()) + "\n";
		s = s + "Interests index: " + String.valueOf(interestIndex) + "\n";
		return s;
	}
	
	public static void main(String arg[])
	{
		long ms = 1506500000000l;
		long icrm = 100000000l;
		
		Question q0 = new Question(1,"How are you?",14,new Date(ms));
		Question q1 = new Question(2,"Who are you?",54,new Date(ms+icrm));
		Question q2 = new Question(3,"Where are you?",67,new Date(ms+icrm*2));
		Question q3 = new Question(4,"Are you OK?",32,new Date(ms+icrm*3));
		Question q4 = new Question(5,"What's up man?",88,new Date(ms+icrm*4));
		Question q5 = new Question(6,"How are you doing?",42,new Date(ms+icrm*5));
		int questionNum = 6;
		Question questions[] = new Question[questionNum];
		questions[0] = q0;
		questions[1] = q1;
		questions[2] = q2;
		questions[3] = q3;
		questions[4] = q4;
		questions[5] = q5;
		
		for(int i = 0;i < questionNum;i++)
		{
			System.out.println(questions[i]);
		}
		Question[] sortedQuetions = Question.sortQuestions(questions);
		System.out.println("After Sort:");
		for(int i = 0;i < questionNum;i++)
		{
			System.out.println(sortedQuetions[i]);
		}
		
		
		
	}

}
