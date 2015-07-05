#include <bits/stdc++.h>
using namespace std;

#define maxsiz 1000000
#define F first
#define S second
#define fr(i,k,n) for(int i = k ; i < n ; i++ )
#define mp(a,b) make_pair(a,b)
#define pb(a) push_back(a)
#define printvect(a,n) fr(i,0,n) cout << a[i] << " " ;
#define point pair<int,int>
#define pii pair<int,int>
#define pib pair<int,bool>
#define vectin(a,n)
typedef unsigned long long int ull;

string IntToString (int a)
{
    ostringstream temp;
    temp<<a;
    return temp.str();
}

int main()
{
	int days,start_h,start_m;
	cin >> days ;
	cin >> start_m >> start_h ;


	int h = start_h ;
	int m = start_m ;

	string hourstring = "" ;
		fr(j,0,8)
		{
			int hr = h+3*j ; 
			if(hr >= 24)
				hr = hr%24 ;
			hourstring = hourstring +  IntToString(hr) ;
			if(j != 7)
				hourstring += ","; 
		}

	string minute_string = "" ;
	fr(j,0,4)
	{
		int mr = m+15*j ; 
		if(mr >= 60)
			mr = mr%60 ;
		minute_string = minute_string +  IntToString(mr) ;
		if(j != 3)
			minute_string += ","; 
	}

	//cout << start_m-1 << " " <<  start_h << "," << (start_h + 12)%24 << " * * * rm log_cron.php" << endl;
	cout << minute_string <<  " *" << " * * * php /var/www/html/harvest_pre.php >> /var/www/html/log_cron.php 2>&1" << endl << endl;

	h = start_h ;
	m = start_m + 1 ;
	
	//cout << hourstring << endl ;

	fr(i,0,days)
	{
		string hourstring = "" ;
		fr(j,0,8)
		{
			int hr = h+3*j ; 
			if(hr >= 24)
				hr = hr%24 ;
			hourstring = hourstring +  IntToString(hr) ;
			if(j != 7)
				hourstring += ","; 
		}

		string minute_string = "" ;
		fr(j,0,4)
		{
			int mr = m+15*j ; 
			if(mr >= 60)
				mr = mr%60 ;
			minute_string = minute_string +  IntToString(mr) ;
			if(j != 3)
				minute_string += ","; 
		}


		fr(j,0,8)
			cout <<  minute_string <<  " *" << " * * * php /var/www/html/harvest_" << j+1 << ".php " << i << " " << i+1 << " >> /var/www/html/log_cron.php 2>&1 " << endl ;
		m += 1 ;
		if(m  >= 60 )
		{
			m = m%60 ;
			h++ ;
		}
		cout << endl ;
	}
	return 0;
}