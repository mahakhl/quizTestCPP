		function inArray(table, value)
			{var i=0;
				for(;i<table.length;i++)
					if(table[i]==value)
						return true;
				return false;
			}
		function send()
			{window.location.href = "view.php?dis=" + Dis;}